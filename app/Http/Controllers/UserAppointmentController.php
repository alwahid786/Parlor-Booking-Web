<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAppointmentController extends Controller
{
    //

    public function userAppointments($uuid= null, Request $request)
    {
        if($request->uuid && (''!=$request->uuid))
        {
            $request->merge([
                'uuid' =>$request->uuid,
            ]);
            return view('User.user_appointments', ['id' => $uuid]);
        }
    }
}
