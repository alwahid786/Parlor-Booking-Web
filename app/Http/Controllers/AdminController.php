<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Offer;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller
{

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

    public function salonStatus($id, $status, Request $request)
    {
        // dd($request->all(),$id, $status);
        $validator = Validator::make($request->all(), [
            'status'  => 'in:accepted,rejected,suspended',
        ]);


        if ($validator->fails()) {
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        User::where('id', $id)->update(['status' => $status]);
        return redirect()->route('admin.show');
        // $updatedUser = User::where('id', $request->statusId)->first();
        // return $updatedUser;
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
        // \DB::delete('delete from users where id = ?',[$request->id]);
        User::where('id',$request->id)->delete();
        return redirect()->route('allUsers');
    }

    public function deleteSalon(Request $request){
        // \DB::delete('delete from users where id = ?',[$request->id]);
        User::where('id',$request->id)->delete();
        return redirect()->route('admin.show');
    }

    public function filterSalon($status){
        $allSalons = User::where('status',$status)->get();
        return view("Admin.filterSalon", compact("allSalons"));
    }

    public function salonDetails($id){

       $salonDetail =  User::where('id',$id)->with(['services','offers'])->first();
        return view("Admin.salonDetails", compact("salonDetail"));
    }

    public function salonCustomers($id){

    $salonCustomers =  Appointment::where('salon_id',$id)->orderBy('created_at', 'desc')->get();
// dd($salonCustomers);
// echo($salonCustomers[0]->appointmentDetails[0]->services->name);
// foreach( $salonCustomers  as $salonCustomer){
//        echo($salonCustomer->date)."</br>";
//        foreach( $salonCustomer->appointmentDetails  as $appointmentDetail){
//         echo($appointmentDetail->price)."</br>";
//         echo($appointmentDetail->services->name)."</br>";
//         // foreach($appointmentDetail->services  as $service){
//         //     echo($service->name)."</br>";  
//         // }
//        }
// }

    return view("Admin.salonCustomers", compact("salonCustomers"));
    }

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

    public function showOrders(Request $request){
        //Yesterday
        $salonCustomers = Appointment::with('salon','user','appointmentDetails')->whereDate('date', Carbon::yesterday())->orderBy('start_time', 'ASC')->get();
        // dd($salonCustomers[0]->salon->phone);
        //Today
        $salonCustomerss = Appointment::with('salon','user','appointmentDetails')->whereDate('date', Carbon::today())->orderBy('start_time', 'ASC')->get();
        //Tomorrow
        $salonCustomersss = Appointment::with('salon','user','appointmentDetails')->whereDate('date', Carbon::tomorrow())->orderBy('start_time', 'ASC')->get();
        // dd($salonCustomers);
        return view("Admin.showorders",compact("salonCustomers","salonCustomerss","salonCustomersss"));

    }
}
