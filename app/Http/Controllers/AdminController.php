<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {

        $allSalons = User::where('type','salon')->get();
        // dd($allSalons);
        return view("Admin.index", compact("allSalons"));

    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
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
}
