<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\Offer;
use App\Models\Service;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAppointment(Request $request){

        $validator = Validator::make($request->all(), [
            'user_uuid' => 'required_without:appointment_uuid|exists:users,uuid',
            'status' => 'in:active,cancelled,completed',
            'offset' => 'numeric',
            'limit' => 'numeric',
            'appointment_uuid' => 'required_without:user_uuid|exists:appointments,uuid',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $appointments = Appointment::orderBy('created_at','DESC');
        
        if(isset($request->appointment_uuid)){
            $appointments = $appointments->where('uuid',$request->appointment_uuid)->with('user')->with('salon', function($query){
                    $query->with('offer');
            })->with('appointmentDetails', function($query){
                    $query->with('services');
            });
        }
        if(isset($request->user_uuid)){

            $user = User::where('uuid', $request->user_uuid)->first();
            if(!$user)
                return sendError("user Not Found",[]);
            if('user' == $user->type)
                $appointments->where('user_id', $user->id)->with(['salon']);
            if('salon' == $user->type)
                $appointments->where('salon_id', $user->id)->with(['user']);   
            if(isset($request->status))
                $appointments->where('status', $request->status);
            if(isset($request->limit))
                $appointments->offset($request->offset??0)->limit($request->limit);
        }

        $appointments = $appointments->get();
        
        return sendSuccess('Appointments',$appointments);                
    }

    public function updateAppointment(Request $request){

        $validator = Validator::make($request->all(), [
            'user_uuid' => 'required_without:appointment_uuid|exists:users,uuid',
            'salon_uuid' => 'required_with:user_uuid|exists:users,uuid',
            'services_uuid' => 'required_with:user_uuid|exists:services,uuid',
            'time' => 'required_with:user_uuid|date_format:H:i',
            'date' => 'required_with:user_uuid|date',
            'appointment_uuid' => 'exists:appointments,uuid',
            'status' => 'required_with:appointment_uuid|in:active,cancelled,completed,rejected'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        if(isset($request->appointment_uuid)){

            $status = Appointment::where('uuid', $request->appointment_uuid)
                ->update(['status' => $request->status]);

            return sendSuccess('Updated Appointment',$status);
        }

        //checks
        $result = $this->userService->checkSalon($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $salon = $result['data'];

        $result = $this->userService->checkUser($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $user = $result['data'];
        
        $result = $this->userService->checkAvailableDate($request,$salon);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        
        $result = $this->userService->checkAvailableSlots($request,$salon);
        $avalible_appointment_slots = $result['data'];
        
        $appointment_time = explode(' ',Carbon::parse($request->time)->format('H:i:s'));
        
        $appointment_time = array_intersect($appointment_time,$avalible_appointment_slots);
        if(NULL == $appointment_time)
            return SendError('Time Slot Not Avalible',[]);


        DB::beginTransaction();
        try{            

            $offer = $salon->where('id',$salon->id)->with(['offer' => function ($query){
                $query->where('status','active');
            }])->first();

            if(null != $offer->offer){
                $discount = $offer->offer->discount == 0?1:$offer->offer->discount/100;
            }

            $total_price = 0;
            $appointment = new Appointment;
            $appointment->uuid = str::uuid();
            $appointment->salon_id = $salon->id;
            $appointment->user_id = $user->id;
            $appointment->status = $request->status??'active';
            $appointment->start_time = Carbon::parse(implode($appointment_time))->format('H:i');//implode array to string
            $appointment->end_time = Carbon::parse($request->time)->addMinutes('30')->format('H:i');
            $appointment->date = $request->date;
            $appointment->total_price = $total_price;
            $appointment->save();

            if(!$appointment->save()){

                DB::rollBack();
                return sendError("Internal Server Error",[]);
            }

            foreach($request->services_uuid as $service_uuid){
                $service = Service::where('uuid',$service_uuid)->first();
                $appointment_details = new AppointmentDetail;
                $appointment_details->uuid = str::uuid();
                $appointment_details->appointment_id = $appointment->id;
                $appointment_details->service_id = $service->id;
                $appointment_details->price = $service->price;
                $appointment_details->save();
                $total_price += $service->price;

                if(!$appointment->save()){

                    DB::rollBack();
                    return sendError("Internal Server Error",[]);
                }
            }

            $appointment->total_price = $total_price;
            if(isset($discount))
                $appointment->total_price = $total_price - ($total_price * $discount);
            
            $appointment->save();

            DB::Commit();
            return sendSuccess('Service Saved',$appointment);
        }
        catch(Exception $e){
            DB::rollBack();
            return sendError($e->getMessage(), $e->getTrace());
        }
    }

    public function availableAppointments(Request $request){

        $validator = Validator::make($request->all(), [
            'salon_uuid' => 'required|exists:users,uuid',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $result = $this->userService->checkSalon($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $salon = $result['data'];
        //time & date to proper format
        $startTime = Carbon::parse($salon->start_time)->modify('-30 minutes');
        $endTime = Carbon::parse($salon->end_time);
        $date = Carbon::parse($request->date);

        //making intervals of 30 minutes 
        while ($startTime->modify('+30 minutes') < $endTime) {
            $salon_time_slots[] = $startTime->format('H:i:s');
        }
        //getting booked appointments and comparing them to to total appointment and getting free slots
        $booked_appointments = Appointment::where('salon_id',$salon->id)->where('date',$date)->pluck('start_time')->toArray();
        $available_appointment_slots = array_values(array_diff($salon_time_slots,$booked_appointments));

        $data['all_slots'] = $salon_time_slots;
        $data['available_slots'] = $available_appointment_slots;
        return sendSuccess('Appointments slots',$data);

    } 

    public function salonOff(Request $request){

        $validator = Validator::make($request->all(), [
            'salon_uuid' => 'required_with:discount|required_without:offer_uuid|exists:users,uuid',
            'discount' => 'required_with:salon_uuid|numeric|min:1',
            'offer_uuid' => 'required_with:status|exists:offers,uuid',
            'status' => 'required_with:offer_uuid|in:active,in-active',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
        
        //for updaing status
        if(isset($request->offer_uuid)){

            $offer = offer::where('uuid',$request->offer_uuid)->first();
            $offer->status = $request->status??'in-active';
            $offer->save();

            DB::Commit();
            return sendSuccess("Offer Status changed",$offer);
        }

        $result = $this->userService->checkSalon($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $salon = $result['data'];

        $check = offer::where('salon_id',$salon->id)->where('status','active')->first();
        if($check)
            return sendError('Discount Already Exists In This Salon',$check);


        DB::beginTransaction();        
        try{
            $offer = new Offer;
            $offer->uuid = str::uuid();
            $offer->salon_id = $salon->id;
            $offer->discount = (int)$request->discount;
            $offer->save();

            DB::commit();
            return sendSuccess('Offer Added',$offer);
        }
        catch(Exception $e){
            DB::rollBack();
            return sendError($e->getMessage(), $e->getTrace());
        }

    } 
}
