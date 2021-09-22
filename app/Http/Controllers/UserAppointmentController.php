<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;

class UserAppointmentController extends Controller
{
    private $userAppointmentCntrl;
    private $userApiCntrl;

    public function __construct(AppointmentController $userAppointmentCntrl, UserController $userApiCntrl)
    {
        $this->userAppointmentCntrl = $userAppointmentCntrl;
        $this->userApiCntrl = $userApiCntrl;
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

    public function search(Request $request)
    {
        // dd($request->all());

        $this->validate($request,[
            'keyword' => 'required_without:location',
            'location' => 'required_without:keyword'
        ]);

        $search = $this->userApiCntrl;
        $apiResponse = $search->getSalon($request)->getData();

        // dd($apiResponse);
        if($apiResponse->status)
        {
            $search_result = $apiResponse->data;

            return view('Home.get_all_salons', ['allSalons' => $search_result, 'book_salon' => 0]);

        }

    }

}
