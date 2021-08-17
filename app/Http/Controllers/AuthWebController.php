<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class AuthWebController extends Controller
{
    private $authApiCntrl;

    public function __construct(AuthController $authApiCntrl)
    {   
        $this->authApiCntrl = $authApiCntrl;
    }

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
            $request->merge([
                'is_socail' => 0
            ]);
            $authCntrl = $this->authApiCntrl;
            // $apiResponse = $authCntrl->
        }

    }
}
