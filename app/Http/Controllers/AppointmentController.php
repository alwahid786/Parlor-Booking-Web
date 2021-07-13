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
            'user_uuid' => 'required|exists:users,uuid',
            'offset' => 'numeric',
            'limit' => 'numeric'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('uuid', $request->user_uuid)->first();
        if(!$user)
            return sendError("user Not Found",[]);

        $appointments = Appointment::orderBy('created_at','DESC');
        
        if('user' == $user->type)
            $appointments->where('user_id', $user->id)->with(['salon']);
        if('salon' == $user->type)
            $appointments->where('salon_id', $user->id)->with(['user']);   


        if(isset($request->limit))
            $appointments->offset($request->offset??0)->limit($request->limit);

        $appointments = $appointments->get();
        
        return sendSuccess('Appointments',$appointments);                
    }

    public function updateAppointment(Request $request){

        $validator = Validator::make($request->all(), [
            'user_uuid' => 'required|exists:users,uuid',
            'salon_uuid' => 'required|exists:users,uuid',
            'services_uuid' => 'required|exists:services,uuid',
            'time' => 'required|date_format:H:i',
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

        $result = $this->userService->checkUser($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $user = $result['data'];
        //checkAvailableSlots returns Available Time slots
        $result = $this->userService->checkAvailableSlots($request,$salon);
        $avalible_appointment_slots = $result['data'];
        //convert Time to proper time format then use explode to convert string to array
        $appointment_time = explode(' ',Carbon::parse($request->time)->format('H:i:s'));
        //array_intersect Returns THe matching once
        $appointment_time = array_intersect($appointment_time,$avalible_appointment_slots);
        if(NULL == $appointment_time)
            return SendError('Time Slot Not Avalible',[]);


        DB::beginTransaction();
        try{
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

        $startTime = Carbon::parse($salon->start_time)->modify('-30 minutes');
        $endTime = Carbon::parse($salon->end_time);
        $date = Carbon::parse($request->date);

        while ($startTime < $endTime) {
            $salon_time_slots[] = $startTime->modify('+30 minutes')->format('H:i:s');
        }

        $booked_appointments = Appointment::where('salon_id',$salon->id)->where('date',$date)->pluck('start_time')->toArray();
        $avalible_appointment_slots = array_values(array_diff($salon_time_slots,$booked_appointments));

        return sendSuccess('Avalible Appointments slots',$avalible_appointment_slots);

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
