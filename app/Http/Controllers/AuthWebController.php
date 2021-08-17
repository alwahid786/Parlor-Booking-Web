<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthWebController extends Controller
{
    public function login(Request $request)
    {
        return view('Auth.login');
    }
    public function create(Request $request)
    {
        // dd($request->all());
        if($request->getMethod() == 'GET')
        {
            return view('Auth.signup');
        }
        else {
            dd($request->all());
        }

    }
}
