<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Http\Controllers\NotificationController;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\Offer;
use App\Models\Service;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService,NotificationController $NotificationController)
    {
        $this->userService = $userService;
        $this->NotificationController = $NotificationController;
    }

    public function getAppointment(Request $request){

        $validator = Validator::make($request->all(), [
            'user_uuid'         => 'exists:users,uuid',
            'status'            => 'in:active,cancelled,completed',
            'offset'            => 'numeric',
            'limit'             => 'numeric',
            'appointment_uuid'  => 'exists:appointments,uuid',
            'past_appointments' => 'in:1',
            'date'              => 'date'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $appointments = Appointment::orderBy('created_at','DESC')
            ->where('status','on-hold')
            ->where('created_at','>',carbon::now()->addSecond(60))
            ->update(['status' => 'cancelled']);

        $appointments = Appointment::orderBy('created_at','DESC');
        
        if(isset($request->appointment_uuid)){
            $appointments = $appointments->where('uuid',$request->appointment_uuid)->with('user')->with('salon', function($query){
                    $query->with('offer');
                })->with('appointmentDetails', function($query){
                    $query->with('services');
            });

            $appointments = $appointments->first();
        
            return sendSuccess('Appointments',$appointments);  
        }

        $user = User::where('uuid', $request->user_uuid??$request->user()->uuid)->first();

        if(!$user)
            return sendError("user Not Found",[]);

        if('user' == $user->type)
            $appointments->where('user_id', $user->id)->with('salon' , function($q){
                $q->with(['media','offer']);
            })->with('appointmentDetails', function($query){
                    $query->with('services');
            });

        if('salon' == $user->type)
            $appointments->where('salon_id', $user->id)->with('user' , function($q){
                $q->with('media');
            })->with('appointmentDetails', function($query){
                    $query->with('services');
            });  

        if(isset($request->date))
            $appointments->where('date',$request->date);

        if(isset($request->status))
            $appointments->where('status', $request->status);

        if(isset($request->past_appointments))
            $appointments->where('date','<',Carbon::now()->format('Y-m-d'));

        if(isset($request->upcoming_appointments))
            $appointments->where('date','>=',Carbon::now()->format('Y-m-d'));

        if(isset($request->limit))
            $appointments->offset($request->offset??0)->limit($request->limit);

        $appointments = $appointments->get();
        
        return sendSuccess('Appointments',$appointments);                
    }

    public function updateAppointment(Request $request){

        $validator = Validator::make($request->all(), [
            'user_uuid'        => 'required_without:appointment_uuid|exists:users,uuid',
            'salon_uuid'       => 'required_with:user_uuid|exists:users,uuid',
            'services_uuid'    => 'required_with:user_uuid|exists:services,uuid',
            'time'             => 'required_with:user_uuid|date_format:H:i',
            'date'             => 'required_with:user_uuid|date',
            'appointment_uuid' => 'exists:appointments,uuid',
            'status'           => 'required_with:appointment_uuid|in:active,cancelled,completed,rejected'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        if(Carbon::parse($request->date)->format('Y-m-d') < Carbon::now()->format('Y-m-d'))
            return sendError('Cannot set past date',[]);

        if(isset($request->appointment_uuid)){

            $status = Appointment::where('uuid', $request->appointment_uuid)->first();

            $status->status = $request->status;
            $status->save();

            $msg = $request->status == 'active' ? 'accepted' : $request->status;

            if($status->user_id != $request->user()->id){

                $noti_text = 'Your Appointment Has Been'.' '.$msg.' by '.$status->salon->name;
                $noti_result = $this->NotificationController->addNotification($status->salon_id,$status->user_id,$status->id,'appointment',$noti_text,true);
            } else {

                $noti_text = 'The Appointment Has Been'.' '.$msg.' by '.$request->user()->name;
                $noti_result = $this->NotificationController->addNotification($status->user_id,$status->salon_id,$status->id,'appointment',$noti_text,true);
            }

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
                $discount = $offer->offer->discount == 0 ? 1 : $offer->offer->discount/100;
            }

            $total_price = 0;
            $appointment = new Appointment;
            $appointment->uuid        = str::uuid();
            $appointment->salon_id    = $salon->id;
            $appointment->user_id     = $user->id;
            $appointment->status      = $request->status ?? 'on-hold';
            $appointment->start_time  = Carbon::parse(implode($appointment_time))->format('H:i');//implode array to string
            $appointment->end_time    = Carbon::parse($request->time)->addMinutes('30')->format('H:i');
            $appointment->date        = $request->date;
            $appointment->total_price = $total_price;
            $appointment->save();

            if(!$appointment->save()){

                DB::rollBack();
                return sendError("Internal Server Error",[]);
            }

            foreach($request->services_uuid as $service_uuid){

                $service = Service::where('uuid',$service_uuid)->first();
                $appointment_details = new AppointmentDetail;
                $appointment_details->uuid           = str::uuid();
                $appointment_details->appointment_id = $appointment->id;
                $appointment_details->service_id     = $service->id;
                $appointment_details->price          = $service->price;
                if(isset($discount)){
                    $appointment_details->discount = $discount * 100;
                }
                $appointment_details->save();

                if(!$appointment->save()){

                    DB::rollBack();
                    return sendError("Internal Server Error",[]);
                }
            }
            $total_price = AppointmentDetail::where('appointment_id',$appointment->id)->pluck('price')->sum();
            $appointment->total_price = $total_price;

            if(isset($discount)){
                $appointment->total_price = $total_price - ($total_price * $discount);
            }
            
            $appointment->save();

            if(!$appointment->save())
                return sendError('Internal Server Error',[]);

            $noti_text = $user->name.' need appointment in your salon';
            $noti_result = $this->NotificationController->addNotification($user->id,$salon->id,$appointment->id,'appointment',$noti_text,true);
            // dd($noti_result);


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
        
        $result = $this->userService->checkAvailableDate($request,$salon);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        //making intervals of 30 minutes 
        if(!($startTime->modify('+30 minutes') < $endTime))
            return sendError('Invalid Time',[]);

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
