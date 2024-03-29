<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\Address;
use App\Models\Category;
use App\Models\Bank;
use App\Models\Card;
use App\Models\SignupVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone_number|string|email|exists:users,email',
            'phone_number' => 'required_without:email',
            'phone_code' => 'required_without:email',
            'password' => 'required',
            'type' => 'required|in:salon,user',
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $credentials = $request->only('email', 'password');

        $check = User::where('email', $request->email)->first();
        // dd($check);
        // if($check->type != $request->type)
        //     return sendError('Invalid Login',[]);

        $login_type = 'email';

        // dd($check);


        if(!$check){
            $check = User::whereRaw("CONCAT(phone_code, phone_number) = ?", [$request->phone_code.$request->phone_number])->first();
            $login_type = 'number';
            $credentials = $request->only('phone_code', 'phone_number', 'password');
        }

        if($check && ($check->email_verified_at == null || $check->email_verified_at == '') && isset($request->email) && $login_type == 'email'){
            $code = mt_rand(1000, 9999);

            DB::delete('Delete from signup_verifications where email = ?',[$request->email]);

            Log::info($code);
            $check = User::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();

            $twilio = new TwilioController;
             $twilioResponse = $twilio->isValidNumber($request->phone_code, $request->phone_number);
            if(!$twilioResponse){
                return sendError('Phone number is invalid', null);
             }
            if($check){
                if($check->email_verified_at == null || $check->phone_verified_at == null){
                    // dd('test');
                    if(!$twilio->sendMessage($request->phone_code.$request->phone_number, 'Enter this code to verify your GlitterUps account ' . $code)) {
                        return sendError('Phone is invalid', NULL);
                    }
                }
            }

            // Mail::send('email_template.verification_code', ['name' => $check->profile->first_name.' '.$check->profile->last_name, 'code' => $code], function ($m) use ($check) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($check->email, $check->profile->first_name.$check->profile->last_name)->subject('Account Verification');
            // });

            // SAVE VERIFICATION TOKEN
            $signupVerification = new SignupVerification;

            $signupVerification->uuid = str::uuid();
            $signupVerification->type = 'email';
            $signupVerification->email = $request->email;
            $signupVerification->token = $code;
            $signupVerification->save();

            $data['code'] = $code;
            // dd($data);
            // return sendSuccess('User Not Verified. Verification code sent to linked Email.', $data);
            return sendSuccess('User Not Verified. Verification code sent to phone.', $data);
        }

        if($check && ($check->phone_verified_at == null || $check->phone_verified_at == '') && isset($request->phone_number) && isset($request->phone_code) && $login_type == 'number'){
        //   dd($request->phone_number);
            $code = mt_rand(1000, 9999);

            DB::delete('Delete from signup_verifications where phone = ?',[$request->phone_code.$request->phone_number]);

            Log::info($code);

            $twilio = new TwilioController;
            if(!$twilio->sendMessage($check->phone_code.$check->phone_number, 'Enter this code to verify your GlitterUps account ' . $code)) {
                return sendError('Phone is invalid', NULL);
            }

            // SAVE VERIFICATION TOKEN
            $signupVerification = new SignupVerification;

            $signupVerification->uuid = str::uuid();
            $signupVerification->type = 'phone';
            $signupVerification->phone = $request->phone_code.$request->phone_number;
            $signupVerification->token = $code;
            $signupVerification->save();

            $data['code'] = $code;
            return sendError('User Not Verified. Verification code sent .', $data);
        }
        if(Auth::attempt($credentials)){
        // dd($check, "12312");
            $user = $request->user();
            // dd($user);
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;

            if(isset($request->remember_me) && $request->remember_me != '' && $request->remember_me == 1)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            User::where('id', $user->id)->update(['is_online' => true]);

            $data['access_token'] = $tokenResult->accessToken;
            $data['token_type'] = 'Bearer';
            $data['expires_at'] = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
            $data['user'] = User::where('id', $request->user()->id)->with(['days','brosche'])->first();
            return sendSuccess('Login successfully.', $data);
        }
        return sendError('Email or password is incorrect.', null);
    }

    public function signup(Request $request){
        $validator = Validator::make($request->all(), [
            'is_social'    => 'required|in:1,0',
            
            'name'         => 'required_if:is_social,0|string',
            'email'        => 'required_if:is_social,0|unique:users,email|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'phone_code'   => 'required_if:is_social,0',
            'phone_number' => 'required_if:is_social,0|unique:users,phone_number',
            'password'     => 'required_if:is_social,0',
            'type'         => 'required_if:is_social,0|in:salon,user',
            
            'social_id'    => 'required_if:is_social,1',
            'social_type'  => 'required_if:is_social,1',
            'gender'       => 'in:male,female,other,both',
        ]);
        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }



        
        $twilio = new TwilioController;
        $twilioResponse = $twilio->isValidNumber($request->phone_code, $request->phone_number);
        if(!$twilioResponse){
            return sendError('Phone number is invalid', null);
        }


        $code = mt_rand(1000, 9999);
        // dd("rest");
        $check = new User;
        $msg = '';
        if($request->is_social == 0){

            $check = User::where('email', $request->email)
                ->orWhere('social_email', $request->email)->first();
        }
        else{
            $check = User::where('email', $request->social_email)
               ->orWhere('social_email', $request->social_email)->first();
        }


        // dd($check);

        if(null != $check){
            return sendError('Email exists already','');
        }

        if($request->is_social == 0){
            $check = User::where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();
            if($check){
                if($check->email == $request->email && $check->phone_number == $request->phone_number) {
                    return sendError('User exists already', null);
                }
                if($check->email == $request->email) {
                    return sendError('Email exists already', null);
                }
                if($check->phone_number == $request->phone_number){
                    return sendError('Phone exists already', null);
                }
            }
            // dd($check);
            // if($check->email_verified_at == null || $check->phone_verified_at == null){
                // if(!$twilio->sendMessage($request->phone, 'Enter this code to verify your Cleaques account ' . $code)) {
                //    return sendError('Phone is invalid', NULL);
                // }
            // }


            if(!$twilio->sendMessage($request->phone_code.$request->phone_number, 'Enter this code to verify your GlitterUps account ' . $code)) {
                return sendError('Phone is invalid', NULL);
            }

            DB::delete('Delete from password_resets where phone = ?',[$request->phone_code.$request->phone_number]);
            DB::insert('Insert into password_resets (type, phone, token) values(?, ?, ?)',['phone', $request->phone_code.$request->phone_number, $code]);

            // return sendSuccess('Code sent on phone', $data);
        

     
        }else{
            $check = User::where('social_email', $request->social_email)->orWhere('social_id', $request->social_id)->first();
            if($check){
                return sendError('User exists already', null);
            }
        }

        try {
            DB::beginTransaction();

            $user = new User;
            $user->uuid = Str::uuid();

            //For Social
            if($request->is_social == 1){
                $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $user->phone_verified_at = Carbon::now()->format('Y-m-d H:i:s');

                if(isset($request->gender))
                    $user->gender = $request->gender;
                if(isset($request->name))
                    $user->name = $request->name;
                if(isset($request->type))
                    $user->type = $request->type;
                if(isset($request->is_social))
                    $user->is_social = $request->is_social;

                if(isset($request->social_type))
                    $user->social_type = $request->social_type;

                if(isset($request->social_id))
                    $user->social_id = $request->social_id;

                if(isset($request->social_email))
                    $user->social_email = $request->social_email;
            }//For Email
            else{

                $user->name = $request->name;
                $user->type = $request->type;
                if(isset($request->gender))
                    $user->gender = $request->gender;
                if(isset($request->is_social))
                    $user->is_social = $request->is_social;

                if(isset($request->email))
                    $user->email = $request->email;

                if(isset($request->phone_code))
                    $user->phone_code = $request->phone_code;

                if(isset($request->phone_number))
                    $user->phone_number = $request->phone_number;

                if(isset($request->password))
                    $user->password = bcrypt($request->password);

            }

            if($user->save()) {
                if($request->is_social == 1){
                        return $this->socialLogin($request);

                }else{
                    // Mail::send('email_template.verification_code', ['name' => $user->name, 'code' => $code], function ($m) use ($user) {
                    //     $m->from(config('mail.from.address'), config('mail.from.name'));
                    //     $m->to($user->email, $user->name)->subject('Account Verification');
                    // });

                    $signupVerification = new SignupVerification;
                    $signupVerification->uuid = Str::uuid();
                    $signupVerification->user_id = $user->id;
                    $signupVerification->type = 'both';
                    $signupVerification->email = $request->email;
                    $signupVerification->phone = $request->phone_code.$request->phone_number;
                    $signupVerification->token = $code;
                    $signupVerification->save();
                    $data['code'] = $code;
                    $data['user'] = $user;

                    if(!$signupVerification->save()){
                        return sendError("Cant save validation code");
                    }

                    DB::commit();
                    return sendSuccess('Successfully Created User', $data);
                }
            }
            else{
                DB::rollBack();
                return sendError('There is some problem.', null);
            }

        }catch (\Exception $ex){
            DB::rollBack();
            $data['exception_error'] = $ex->getMessage();
            return sendError('There is some problem.', $data);
        }

        DB::rollBack();
        return sendError('There is some problem.', null);
    }

    public function changeSocialLoginPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'new_password' =>'required',
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
        $user = User::where('id', \Auth::user()->id)->first();

        if(null == $user){
            return sendError('404. User Not Found', null);
        }


        try{
            $user->password = bcrypt($request->new_password);
            $user->is_social_password_updated = 1;

            $user->save();
            return sendSuccess('Password Updated Successfully', null);
        }
        catch (\Exception $ex){
            DB::rollBack();
            $data['exception_error'] = $ex->getMessage();
            return sendError('There is some problem.', $data);
        }
    }

    public function socialLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'social_email' =>'required_unless:social_type,apple',
            'social_type' => 'required',
            'social_id' => 'required'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = null;

        if($request->social_type == 'apple'){
            $user = User::where('social_id', $request->social_id)->first();
        }else{
            $user = User::where('social_email',  $request->social_email)->where('social_id', $request->social_id)->first();
        }

        $check1 = User::where('social_email',  $request->social_email)->first();
        if(!$user && $check1){
            return sendError('Email has been registered already with another account.', null);
        }

        $check2 = User::where('social_id', $request->social_id)->first();
        if(!$user && $check2){
            return sendError('Account has been registered with another email.', null);
        }

        if(!$user){
            return sendError('not_registered.', null);
        }

        Auth::login($user);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        User::where('id', $user->id)->update(['is_online' => true]);

        $data['access_token'] = $tokenResult->accessToken;
        $data['token_type'] = 'Bearer';
        $data['expires_at'] = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
        $data['user'] = getUser()->where('id', $request->user()->id)->first();
        DB::commit();
        return sendSuccess('Login successfully.', $data);
    }

    public function verifyUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email'
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('email',  $request->email)->first();

        if(!$user){
            return sendError('Email is not registered.', null);
        }

        Auth::login($user);

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        User::where('id', $user->id)->update(['email_verified_at' => Carbon::now('utc')->format('Y-m-d H:i:s'), 'phone_verified_at' => Carbon::now('utc')->format('Y-m-d H:i:s')]);
        // Profile::where('id', $user->profile_id)->update(['is_online' => true]);

        $data['access_token'] = $tokenResult->accessToken;
        $data['token_type'] = 'Bearer';
        $data['expires_at'] = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
        $data['user'] = getUser()->where('id', $request->user()->id)->first();
        return sendSuccess('Verified successfully.', $data);
    }

    public function verifyUserWithCode(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required_if:activation_type,email',
            'activation_phone_code' => 'required_if:activation_type,phone',
            'activation_phone_number' => 'required_if:activation_type,phone',
            'activation_code' => 'required',
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $check = SignupVerification::where('email',$request->email)->where('token',$request->activation_code)->get();

        if(count($check) < 1){
            return sendError('Code does not match', null);
        }

        DB::delete('Delete from signup_verifications where email = ?',[$request->email]);

        $user = User::where('email',  $request->email)->first();

        if(!$user){
            return sendError('Email is not registered.', null);
        }

        User::where('id', $user->id)->update(['email_verified_at' => Carbon::now('utc')->format('Y-m-d H:i:s')]);

        return sendSuccess('Verified successfully.', null);
    }

    public function logout(Request $request){
        $user = $request->user();
        if($user){

            $user->token()->revoke();
            User::where('id', $user->id)->update(['is_online' => false]);
        }
        return sendSuccess('Successfully logged out', null);
    }

    public function user(Request $request){
        $data['user'] = ($request->user_id) ? getUser()->where('id', $request->user_id)->first() : getUser()->where('id', $request->user()->id)->first();
        if($data['user']){
            return sendSuccess('success.', $data);
        }
        return sendError('User Not Found.', null);
    }

    public function forgotPasswordCode(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'reference' => 'required'
        ]);
        // dd($request->all());
        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = getUser()->where('email', $request->reference)->first();
        $type = 'email';

        if(!$user){
            $user = getUser()->whereRaw("CONCAT(phone_code, phone_number) = ?", [$request->reference])->first();
            // dd($user);
            $type = 'phone';
        }
        if(!$user){
            return sendError('User not found', null);
        }

        $code = mt_rand(1000, 9999);
        $data['code'] = $code;
        $data['type'] = $type;
        $data['name'] = $user->email;

        if($type == 'email'){
            // Mail::send('email_template.forgot_password', ['name' => $user->name, 'code' => $code], function ($m) use ($user) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($user->email, $user->name)->subject('Forget Password Rquest');
            // });

            DB::delete('Delete from password_resets where email = ?',[$user->email]);
            DB::insert('Insert into password_resets (type, email, token) values(?, ?, ?)',['email', $user->email, $code]);

            return sendSuccess('Code sent on email', $data);

        }elseif($type == 'phone'){
            $twilio = new TwilioController;
            if(!$twilio->sendMessage($user->phone_code.$user->phone_number, 'Enter this code to verify your GlitterUps account ' . $code)) {
                return sendError('Phone is invalid', NULL);
            }

            DB::delete('Delete from password_resets where phone = ?',[$user->phone_code.$user->phone_number]);
            DB::insert('Insert into password_resets (type, phone, token) values(?, ?, ?)',['phone', $user->phone_code.$user->phone_number, $code]);

            return sendSuccess('Code sent on phone', $data);
        }
        return sendError('There is some problem.', null);
    }

    public function recoverPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'reference' => 'required',
            'password' => 'required',
            'code' => 'required',
        ]);

        if($validator->fails()){
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $check = DB::select('Select * from password_resets where (email = ? AND token = ?) OR (phone = ? AND token = ?)',[$request->reference, $request->code, $request->reference, $request->code]);

        if(count($check)){
            $user = User::where('email', $request->reference)->orwhereRaw("CONCAT(phone_code, phone_number) = ?", [$request->reference])->first();
        }

        if(!isset($user)){
            return sendError('User not found', null);
        }

        $user->password = bcrypt($request->password);

        if($user->save()){
            DB::delete('Delete from password_resets where id = ?',[$check['0']->id]);
            return sendSuccess('Password updated successfully', null);
        }

        return sendError('There is some problem.', null);
    }

    public function resendVerificationToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone_number|email',
            'phone_number' => 'required_without:email',
            'phone_code' => 'required_without:email', // basically country code
        ]);

        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


        // get user based on email|phone
        if(isset($request->email) && $request->email != ''){
            $user = User::where('email', $request->email)->first();
        }
        else{
            $user = User::where('phone_number', $request->phone_number)->where('phone_code', $request->phone_code)->first();
        }
        if(null == $user){
            // return false;
            return sendError('Invalid or Expired Information Provided', null);
        }


        // get verification code based on email|phone
        if(isset($request->email) && $request->email != ''){
            $veridicationModel = SignupVerification::where('email', $request->email)->first();
        }
        else{
            $veridicationModel = SignupVerification::where('phone', $request->phone_code . $request->phone_number)->first();
        }

        // create existing verification code and delete old one
        if(null != $veridicationModel){
            $veridicationModel->delete();
        }
        $code = mt_rand(1000, 9999);

        if(!$this->sendVerificationToken($user, $code, $request)){
            return false;
            // return sendError('Something went wrong while sending Activation Code.', []);
        }
        $data['code'] = $code;
        $data['user'] = $user;
        // return $data;
        return sendSuccess('Verification Token Sent Successfully.', $data);
    }

    public function sendVerificationToken($user, $code, $request)
    {
        $verificationModel = new SignupVerification();
        if (isset($request->phone_number) && isset($request->phone_code)) {
            $twilio = new TwilioController;
            if (!$twilio->sendMessage($request->phone_code . $request->phone_number, 'Enter this code to verify your Sellx account ' . $code)) {
                return false;
                // return sendError('Somthing went wrong while send Code over phone', NULL);
            }
            $verificationModel->type = 'phone';
            $verificationModel->phone = (strpos($request->phone_number, '+') > -1)? $request->phone_number : $request->phone_code . $request->phone_number;
            $verificationModel->email = null;
        } else {
            $email_address = (null != $user->email)? $user->email : $request->email;
            // Mail::send('email_template.verification_code', ['code' => $code], function ($m) use ($email_address) {
            //     $m->from(config('mail.from.address'), config('mail.from.name'));
            //     $m->to($email_address)->subject('Verification');
            // });
            $verificationModel->type = 'email';
            $verificationModel->email = $request->email;
            $verificationModel->phone = null;
        }
        $verificationModel->token = $code;
        $verificationModel->created_at = date('Y-m-d H:i:s');

        // if (isset($request->phone_number) && isset($request->phone_code)) {
        //     $user->phone_verified_at = null;
        // }
        // else{
        //     $user->email_verified_at = null;
        // }
        return ($verificationModel->save());
    }

}
