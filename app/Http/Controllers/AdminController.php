<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Offer;
use Carbon\Carbon;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{
    // use AuthenticatesUsers;
    public function adminRedirect(Request $request)
    {
        // if (!\Auth::check()) {
            // dd('test');
            return redirect()->route('admin.login');
        // }
    }

    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            // dd('res'); 
            return view('Admin.login');
        } else {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                $data['validation_error'] = $validator->getMessageBag();
                return sendError($validator->errors()->all()[0], $data);
            }



            $credentials = $request->only('email', 'password');
            if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
                // dd($credentials);
                $user = Admin::where('email', $request->email)->first();
                // dd($user);
                Auth::guard('admin')->login($user);
                return redirect()->route('admin.show');
            }
        }
    }
  


    public function show(Request $request)
    {
        // if (\Auth::check()) {
            $allSalons = User::where('type', 'salon')->paginate(10);
            // dd($allSalons);
            return view("Admin.index", compact("allSalons"));
        // }
    }

    public function salonStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status'  => 'in:accepted,rejected',
        ]);


        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        User::where('id', $request->statusId)->update(['status' => $request->status]);
        $updatedUser = User::where('id', $request->statusId)->first();
        return $updatedUser;
    }

    public function discountAdd(Request $request)
    {
        $time = Carbon::now();
        $time = explode(" ", $time->toDateTimeString());
        if ($time) {
            $currentTime = $time[1];
        }

        $validator = Validator::make($request->all(), [
            'discountAmount'  => 'required',
            'expirayDate' => 'required|date'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $services = Service::where('salon_id', $request->discountId)->get();
        $service = Service::where('salon_id', $request->discountId)->first();
        // dd($service);
        // $servicePrice = Service::where('salon_id',$request->discountId)->pluck('price');
        $offer = Offer::where('salon_id', $request->discountId)->first();
        // dd($services);
        if (isset($offer)) {
            if ($offer->salon_id == $request->discountId) {
                Offer::where('salon_id', $request->discountId)->update([
                    'service_id'       => $service->id,
                    'salon_id' => $service->salon_id,
                    'price'   => $service->price,
                    'name'      => $service->name,
                    'discount'       => $request->discountAmount,
                    'end_at'   => $request->expirayDate . " " . $currentTime ?? '',
                    'status'     => 'active',

                ]);
            }
        } else {
            foreach ($services as $service) {

                // dd($service);
                $discount = new Offer();
                $discount->uuid = \Str::uuid();
                $discount->service_id = $service->id;
                $discount->salon_id = $service->salon_id;
                $discount->price = $service->price;
                $discount->name = $service->name;
                $discount->discount = $request->discountAmount;
                $discount->end_at = $request->expirayDate . " " . $currentTime ?? '';
                $discount->status = 'active';
                $discount->save();
            }
        }

        if (isset($offer)) {
            $expire = explode(" ", $offer->end_at);
            $created = explode(" ", $offer->created_at);
            $salon_id = $offer->salon_id;

            if ((strcmp($expire[0], $created[0]) == 0)) {
                Offer::where('salon_id', $salon_id)->update(['discount' => 'Null']);
            }
        }
    }

    public function allUsers()
    {
        // if (\Auth::check()) {
            // $allUsers = User::where('type', 'user')->get();
            $allUsers = User::where('type', 'user')->paginate(10);
            // dd($allUsers);
            return view("Admin.users", compact("allUsers"));
        // } else {
        //     return redirect()->route('admin.login');
        // }
    }

    public function aboutUs()
    {
        // if (\Auth::check()) {
            return view('Admin.aboutus');
        // } else {
        //     return redirect()->route('admin.login');
        // }
    }

    public function privacyPolicy()
    {
        // if (\Auth::check()) {
            return view('Admin.privacy_policy');
        // } else {
        //     return redirect()->route('admin.login');
        // }
    }

    public function termsConditions()
    {
        // if (\Auth::check()) {
            return view('Admin.terms_conditions');
        // } else {
        //     return redirect()->route('admin.login');
        // }
    }

    public function logout(Request $request)
    {

        // $guards = array_keys(config('auth.guards'));
        // dd($guards);
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

        // if (Auth::guard('admin')->logout()) {
        //     return redirect()->route('admin.login');
        // }
    }

    public function deleteUser(Request $request){
        // dd($request->id);
        \DB::delete('delete from users where id = ?',[$request->id]);
        return redirect()->route('allUsers');
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     return redirect()->route('admin.show');
    // }



    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     if ($response = $this->loggedOut($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new JsonResponse([], 204)
    //         : redirect('/');
    // }
    // protected function loggedOut(Request $request)
    // {
    //     return redirect()->route('admin.login');
    // }

    // protected function guard()
    // {
    //     return Auth::guard('admin');
    // }
}
