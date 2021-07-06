<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\Service;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
    }

    public function updateAppointment(Request $request){

        $validator = Validator::make($request->all(), [
            'user_uuid' => 'required|exists:users,uuid',
            'salon_uuid' => 'required|exists:users,uuid',
            'services_uuid' => 'required|exists:services,uuid',
            'time' => 'required|date_format:H:i:s',
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

        DB::beginTransaction();
        try{
            $total_price = 0;
            $appointment = new Appointment;
            $appointment->uuid = str::uuid();
            $appointment->salon_id = $salon->id;
            $appointment->user_id = $user->id;
            $appointment->status = $request->status??'active';
            $appointment->start_time = $request->time;
            $appointment->end_time = $request->time;
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
            return sendError($e->getMessage(), $e->getTrace());
        }
        dd($request->service_uuid);

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

        $startTime = Carbon::parse($salon->start_time);
        $endTime = Carbon::parse($salon->end_time);
        $totalDuration = $endTime->diff($startTime)->format('%H:%I:%S');

        dd( floor($salon->start_time%3600) );
        // dd($totalDuration/'30');

        // $date = Carbon::createFromFormat('m/d/Y', $request->date)->format('l');
        // var_dump($date);  
    } 

    public function salonOff(Request $request){

        $validator = Validator::make($request->all(), [
            'salon_uuid' => 'required|exists:users,uuid',
            'discount' => 'required|numeric',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $result = $this->userService->checkSalon($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $salon = $result['data'];
        
         
    } 
}
