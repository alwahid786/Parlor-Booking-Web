<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AppointmentController;

class UserAppointmentController extends Controller
{
    private $userAppointmentCntrl;

    public function __construct(AppointmentController $userAppointmentCntrl)
    {
        $this->userAppointmentCntrl = $userAppointmentCntrl;
    }

    public function userAppointments($uuid= null, Request $request)
    {
        // dd($request->all());
        if($request->uuid && (''!=$request->uuid))
        {
            $request->merge([
                'user_uuid' =>$request->uuid,
            ]);

            $userAppointments = $this->userAppointmentCntrl;
            $apiResponse = $userAppointments->getAppointment($request)->getData();
            if($apiResponse->status)
            {
                $user_appointments = $apiResponse->data;
                return view('User.user_appointments', ['user_appointments' => $user_appointments, 'book_salon' =>1]);

            }
        }
    }


    public function userAllAppointments($uuid = null, Request $request)
    {
        // dd($request->all());
        if ($request->uuid && ('' != $request->uuid)) {
            $request->merge([
                'user_uuid' => $request->uuid,
            ]);

            $userAppointments = $this->userAppointmentCntrl;
            $apiResponse = $userAppointments->getAppointment($request)->getData();
            if ($apiResponse->status) {
                $user_appointments = $apiResponse->data;
                return view('User.all_appointments', ['user_appointments' => $user_appointments, 'book_salon' => 1]);
            }
        }
    }


}
