<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Redis;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AuthWebController extends Controller
{
    private $authApiCntrl;

    public function __construct(AuthController $authApiCntrl)
    {
        $this->authApiCntrl = $authApiCntrl;
    }


    public function login(Request $request)
    {

        if ($request->getMethod() == 'GET') {
            return view('Auth.login');
        } else {
            $adminCheck = \DB::table('users')->where('email', '=', $request->email)->where('type','=','admin')->get();
            if (isset($adminCheck) && ($adminCheck == []) && empty($adminCheck)) {
                // dd($adminCheck,'test');
                // if ($adminCheck->type == 'admin') {
                    return sendError('Invalid Email or Password', []);
                // }
            }
            // dd($request->all());

            $authCntrl = $this->authApiCntrl;
            $apiResponse = $authCntrl->login($request)->getData();
            if ($apiResponse->status) {
                return sendSuccess('Logged In successfully', $apiResponse->data);
            }
            return sendError('Invalid Email or Password', []);
        }
    }

    //admin login
    public function adminLogin(Request $request)
    {

        if ($request->getMethod() == 'GET') {
            return view('Admin.login');
        } else {
            // dd($request->all());

            $validator = Validator::make($request->all(), [
                'email' => 'required_without:phone_number|string|email|exists:users,email',
                // 'phone_number' => 'required_without:email',
                // 'phone_code' => 'required_without:email',
                'password' => 'required',
                'type' => 'required|admin',
            ]);

            if ($validator->fails()) {
                $data['validation_error'] = $validator->getMessageBag();
                return sendError($validator->errors()->all()[0], $data);
            }

            // dd($request->all());
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // dd($credentials, "asdasd");
                $user = $request->user();

                // dd($user);

                if ($user->type == $request->type) {
                    return sendSuccess('Login Done Successfully', $user);
                }
            } else {
                return sendError('invalid email or password', []);
            }


            // $authCntrl = $this->authApiCntrl;
            // $apiResponse = $authCntrl->login($request)->getData();
            // dd($apiResponse);
            // if ($apiResponse->status) {
            //     return sendSuccess('Logged In successfully', $apiResponse->data);
            // }
            // return sendError('Invalid Email or Password', []);
        }
    }


    public function create(Request $request)
    {
        // dd($request->all());
        if ($request->getMethod() == 'GET') {
            return view('Auth.signup');
        } else {
            // dd($request->all());
            $phone_code = "+" . $request->phone_code;
            $request->merge([
                'is_social' => 0,
                'phone_code' => $phone_code
            ]);
            // dd($request->all());
            $authCntrl = $this->authApiCntrl;
            $apiResponse = $authCntrl->signup($request)->getData();
            // dd($apiResponse);
            if ($apiResponse->status) {
                return sendSuccess('Signup successfully', $apiResponse->data);
            }
        }
    }

    public function enterCode(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            if ((isset($request->email) && ('' != $request->email)) || (isset($request->type) && ($request->type)) || (isset($request->user_type) && ($request->user_type))) {

                return view('Auth.email_template.enterCode', ['email' => $request->email, 'type' => $request->type, 'user_type' => $request->user_type]);
            } else {
                return abort(422, 'Email is Required');
            }
        } else {

            // dd($request->all());
            $authCntrl = $this->authApiCntrl;
            $apiResponse = $authCntrl->verifyUserWithCode($request)->getData();
            if ($apiResponse->status) {
                return sendSuccess('Access token verified successfully', $apiResponse->data);
            }
            return sendError('Invalid token', []);
        }
    }

    public function forgotPassword(Request $request)
    {
        // dd($request->all());
        if ($request->getMethod() == 'GET') {
            return view('Auth.email_template.forgotPassword');
        } else {
            $authCntrl = $this->authApiCntrl;
            $apiResponse = $authCntrl->forgotPasswordCode($request)->getData();
            if ($apiResponse->status) {
                return sendSuccess('Code Send successfully to your email', $apiResponse->data);
            }
            return sendError('Invalid Email ', []);
        }
    }

    public function resetPassword(Request $request)
    {
        // dd($request->all());
        if ($request->getMethod() == 'GET') {
            if ((isset($request->code) && ('' != $request->code)) && ((isset($request->email)) && ('' != $request->email))) {
                return view('Auth.email_template.newPassword', ['code' => $request->code, 'email' => $request->email]);
            }
        } else {
            $request->merge([
                'reference' => $request->email
            ]);
            // dd($request->all());
            $authCntrl = $this->authApiCntrl;
            $apiResponse = $authCntrl->recoverPassword($request)->getData();
            // dd($apiResponse);
            if ($apiResponse->status) {
                return sendSuccess('Password Changed Successfully', $apiResponse->data);
            }
            return sendError('Invalid Email ', []);
        }
    }

    public function logout(Request $request)
    {
        // Auth::logout();
        // return redirect()->route('home');
        Auth::guard('web')->logout();

        return redirect()->route('home');
        // if (Auth::guard('web')->logout()) {
        //     return redirect()->route('home');
       
        // }
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        return $user;

        $this->_regirsterOrLoggedIn($user);

        return redirect()->route('home');
    }

    protected function _regirsterOrLoggedIn($data)
    {
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            $user = new User;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->is_social = 1;
            $user->social_id = $data->id;
            $user->social_email = $data->email;
            $user->social_type = 'google';
            $user->type = 'user';
            $user->address = $data->address;
            $user->gender = $data->gender;
            $user->save();
        }

        Auth::login($user);
    }
}
