<?php

namespace App\Http\Controllers;
use App\Exceptions\Handler;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function updateProfile(Request $request){

    	$validator = Validator::make($request->all(), [
    		'user_uuid' => 'required|exists:users,uuid',
    		'name' => 'required',
    		'address' => 'required',
    		'lat' => 'required|numeric',
    		'long' => 'required|numeric',
    		'start_time' => 'required|date_format:H:i',
    		'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        DB::beginTransaction();     
        try {

        	$user_id = User::where('uuid',$request->user_uuid)->first()->id;
        	$check = Profile::where('user_id',$user_id);
        	
        	if($check->count() >= 2)
	        	return sendError("Profile Already Registered",$check->get());

	        $profile = [
	        	'uuid' => str::uuid(),
	        	'user_id' => $user_id,
	        	'name' => $request->name,
	        	'address' => $request->address,
	        	'lat' => $request->lat,
	        	'long' => $request->long,
	        	'start_time' =>  $request->start_time,
	        	'end_time' => $request->end_time,
	        	'type' => 'salon',
	        ];
	        $profile = Profile::create($profile);

	        if(!$profile){

	    		DB::rollBack();
	        	return sendError("internal Server Error",[]);
	        }

        	DB::commit();
        	return sendSuccess('Profile Created',$profile);
	    }
	    catch (Exception $e) {
	    	DB::rollBack();
	        return sendError($e->getMessage(), $e->getTrace());
	    }
    }

    public function deleteProfile(Request $request){

    	$validator = Validator::make($request->all(), [
    		'user_uuid' => 'required_without:profile_uuid|exists:users,uuid',
    		'profile_uuid' => 'required_without:user_uuid|exists:profiles,uuid',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }


    	DB::beginTransaction(); 
    	try{
    		if(isset($request->profile_uuid)){

    			$profile = Profile::where('uuid',$request->profile_uuid)->where('type','salon')->first();

        		if(null == $profile)
        			return sendError('Profile not found',[]);

				$profile->delete();
    		}
    		if(isset($request->user_uuid)){

    			$user = User::where('uuid',$request->user_uuid)->first();
    			
        		if(null == $user)
        			return sendError('User not found',[]);

				$profile = Profile::where('user_id',$user->id)->delete();
				$user->delete();
    		}

    		DB::commit();
    		return sendSuccess('Deleted profile',[]);
    	}
    	catch (Exception $e){
    		DB::rollBack();
        	return sendError($e->getMessage(), $e->getTrace());
    	}
    }

    public function salonDays(Request $request){
        $validator = Validator::make($request->all(), [
            'salon_uuid' => 'required|exists:profiles,uuid',
            'days' => 'required',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }
        $salon = Profile::where('uuid',$request->salon_uuid)->where('type','salon')->first();
        if(!$salon)
            return sendError('Salon not found',[]);

        $days = json_decode($request->days);
        
        return sendSuccess('dsa',$days);
    }
}
