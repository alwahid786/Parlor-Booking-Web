<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;

class SaloonDashboardController extends Controller
{

    private $userApiCntrl;
    private $serviceApiCntrl;
    private $appointmentApiCntrl;

    public function __construct(UserController $userApiCntrl, ServiceController $serviceApiCntrl, AppointmentController $appointmentApiCntrl)
    {
        $this->userApiCntrl = $userApiCntrl;
        $this->serviceApiCntrl = $serviceApiCntrl;
        $this->appointmentApiCntrl = $appointmentApiCntrl;
    }


    public function dashboard($uuid = null, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            if(isset($request->uuid) && ('' !== $request->uuid)) {
                $request->merge(['user_uuid' => $request->uuid]);
                $appointments = $this->appointmentApiCntrl;
                $apiResponse = $appointments->getAppointment($request)->getData();
                if ($apiResponse->status){
                    $appointments = $apiResponse->data;
                    return view('Dashboard.saloon_dashboard', ['id' => $request->uuid, 'appointments' => $appointments]);
                }
                return view('Dashboard.saloon_dashboard', ['id' => $request->uuid, 'appointments'=>'']);
            }
            $request->merge(['user_uuid' => $uuid]);
            $appointments = $this->appointmentApiCntrl;
            $apiResponse = $appointments->getAppointment($request)->getData();
            if ($apiResponse->status) {
                $appointments = $apiResponse->data;
                return view('Dashboard.saloon_dashboard', ['id' => $uuid, 'appointments' => $appointments]);
            }
            return view('Dashboard.saloon_dashboard', ['id' => $uuid, 'appointments' => '']);
        }
    }

    public function profile($uuid, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $request->merge(['id' => $request->uuid]);
            $userCntrl = $this->userApiCntrl;
            $apiResponse = $userCntrl->getUser($request)->getData();
            $data = $apiResponse->data;
            // dd($apiResponse->data);
            if($apiResponse->status)
            {
                return view('Profile.index', ['profile' => $data, 'id'=> $data->uuid]);
            }
        }
    }

    public function service($uuid, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $request->merge(['salon_uuid' => $request->uuid]);
            $serviceCntrl = $this->serviceApiCntrl;
            $apiResponse = $serviceCntrl->getService($request)->getData();

            if ($apiResponse->status) {
                $getServices = $apiResponse->data;
                return view('Profile.service', ['id' => $uuid, 'getServices' =>$getServices]);
            }

            return view('Profile.service',['id'=>$uuid]);
            // $request->merge(['id' => $request->uuid]);
            // $userCntrl = $this->userApiCntrl;
            // $apiResponse = $userCntrl->getUser($request)->getData();
            // $data = $apiResponse->data;
            // // dd($apiResponse->data);
            // if ($apiResponse->status) {
            //     return view('Profile.service', ['profile' => $data, 'id' => $data->uuid]);
            // }
        }
    }

    public function addService($uuid,Request $request)
    {
        $request->merge([
            'salon_uuid' => $uuid,
            'name' => $request->service_name,
        ]);

        if(isset($request->service_id) && ('' !== $request->service_id))
        {
            $request->merge([
                'service_uuid' => $request->service_id,
            ]);
            $serviceCntrl = $this->serviceApiCntrl;
            $apiResponse = $serviceCntrl->updateService($request)->getData();
            if ($apiResponse->status) {
                return sendSuccess('Services updated successfully', $apiResponse->data);
            }
            return sendError('Service are not updated successfully', []);
        }
        else {
            $serviceCntrl = $this->serviceApiCntrl;
            $apiResponse = $serviceCntrl->updateService($request)->getData();
            if ($apiResponse->status) {
                return sendSuccess('Services added successfully',$apiResponse->data);
            }
            return sendError('Service are not added successfully',[]);
        }
    }



    public function availability($uuid, Request $request)
    {
        $request->merge([
            'salon_uuid' => $uuid,
        ]);
        if ($request->getMethod() == 'GET') {
            $userCntrl = $this->userApiCntrl;
            $apiResponse = $userCntrl->getUser($request)->getData();
            if ($apiResponse->status) {
                $appointments = $apiResponse->data;
                return view('Profile.availability', ['id'=> $uuid , 'appointments'=> $appointments->days]);
            }
            return sendError('Service are not added successfully', []);

        }
    }

    public function aboutUs($uuid,Request $request)
    {
        if($request->getMethod() == 'GET')
        {
            return view('Profile.aboutus',['id'=> $uuid ]);
        }
    }

    public function appointments($uuid, Request $request)
    {
        if($request->getMethod() == 'GET')
        {
            $request->merge(['user_uuid'=> $uuid ]);
            $appointments = $this->appointmentApiCntrl;
            $apiResponse = $appointments->getAppointment($request)->getData();
            if ($apiResponse->status) {
                $all_appointments = $apiResponse->data;
                return view('Profile.appointments', ['id'=> $uuid, 'all_appointments' => $all_appointments]);
            }
            return view('Profile.appointments', ['id' => $uuid]);
        }
    }


    public function pastAppointments($uuid, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $request->merge([
                'user_uuid' => $uuid,
                'past_appointments' => 1
            ]);
            $appointments = $this->appointmentApiCntrl;
            $apiResponse = $appointments->getAppointment($request)->getData();
            if ($apiResponse->status) {
                $past_appointments = $apiResponse->data;
                return view('Profile.past_appointments', ['id' => $uuid, 'past_appointments' => $past_appointments]);
            }
            return view('Profile.past_appointments', ['id' => $uuid]);
        }
    }


    public function acceptAppointment($uuid, Request $request)
    {
        if ($request->getMethod() == 'GET')
        {
            return "ok";
        }
        else {
            $request->merge([
                'appointment_uuid' => $uuid,
                'status' => 'active'
            ]);
            $appointments = $this->appointmentApiCntrl;
            $apiResponse = $appointments->updateAppointment($request)->getData();
            // dd($apiResponse);
            if ($apiResponse->status) {
                $active_appointments = $apiResponse->data;
                return sendSuccess('Appointment accepted successfully', $active_appointments);
            }
            return sendError('Appointment is not accepted successfully', []);

        }

    }




    public function cancelAppointment($uuid, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return "ok";
        } else {
            $request->merge([
                'appointment_uuid' => $uuid,
                'status' => 'cancelled'
            ]);
            $appointments = $this->appointmentApiCntrl;
            $apiResponse = $appointments->updateAppointment($request)->getData();
            // dd($apiResponse);
            if ($apiResponse->status) {
                $cancel_appointments = $apiResponse->data;
                return sendSuccess('Appointment cancelled successfully', $cancel_appointments);
            }
            return sendError('Appointment is not cancelled successfully', []);
        }
    }



    public function profileSetting($uuid, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $request->merge(['id' => $request->uuid]);
            // $userCntrl = $this->userApiCntrl;
            // $apiResponse = $userCntrl->getUser($request)->getData();
            // $data = $apiResponse->data;
            // // dd($apiResponse->data);
            // if ($apiResponse->status) {
            //     return view('Profile.index', ['profile' => $data, 'id' => $data->uuid]);
            // }
            return view('Profile.profile_setting', ['id' => $uuid]);
        }
    }

}
