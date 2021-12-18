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
        // $validator = Validator::make($request->all(), [
        //     'discountAmount'  => 'required|min:0|max:100',
        // ]);
        
        
        // if ($validator->fails()) {
            
        //     $data['validation_error'] = $validator->getMessageBag();
        //     return sendError($validator->errors()->all()[0], $data);
        // }
        $serviceId = Service::where('salon_id',$request->discountId)->pluck('id');
        $servicePrice = Service::where('salon_id',$request->discountId)->pluck('price');

        // dd($serviceId,$servicePrice);

        $discount = new Offer();
        $discount->uuid = \Str::uuid();
        $discount->service_id = $serviceId[0];
        $discount->salon_id = $request->discountId;
        $discount->discount = $request->discountAmount;
        $discount->price = $servicePrice;
        $discount->status = 'active';
        $discount->name = 'services';
        $discount->end_at = '11-12-13';
        $discount->save();

        

    }
    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect()->route('adminLogin');
    }

}
