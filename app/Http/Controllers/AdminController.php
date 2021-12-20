<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{

    public function show(Request $request)
    {

        $allSalons = User::where('type','salon')->get();
        // dd($allSalons);
        return view("Admin.index", compact("allSalons"));

    }
    public function salonStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'status'  => 'in:accepted,rejected',
        ]);
        
        
        if ($validator->fails()) {
            
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
        
        User::where('id', $request->statusId)->update(['status' => $request->status]);  
        $updatedUser = User::where('id',$request->statusId)->first();   
        return $updatedUser;
    }

    public function discountAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'discountAmount'  => 'required|min:0|max:100',
            
        ]);
        
        
        if ($validator->fails()) {
            
            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
        $services = Service::where('salon_id',$request->discountId)->get();
        // $servicePrice = Service::where('salon_id',$request->discountId)->pluck('price');

        // dd($services);
        foreach($services as $service){
        
            // dd($service);
            $discount = new Offer();
            $discount->uuid = \Str::uuid();
            $discount->service_id = $service->id;
            $discount->salon_id = $service->salon_id;
            $discount->price = $service->price;
            $discount->name = $service->name;
            $discount->discount = $request->discountAmount;
            $discount->status = 'active';
            $discount->end_at = '01-11-2022 10:10:10';
            $discount->save();
        }
        
    }
    public function allUsers(){

        $allUsers = User::where('type','user')->get();
        return view("Admin.users", compact("allUsers"));
    }

    public function aboutUs()
    {
        return view('Admin.aboutus');
    }

    public function privacyPolicy()
    {
        return view('Admin.privacy_policy');
    }
    public function termsConditions()
    {
        return view('Admin.terms_conditions');
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect()->route('adminLogin');
    }

}
