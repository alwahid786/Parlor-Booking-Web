<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Day;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
	private $userService;
	
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

    public function updateUser(Request $request){

    	$validator = Validator::make($request->all(), [
    		'user_uuid' => 'required|exists:users,uuid',
    		'address' => 'string',
    		'lat' => 'numeric|required_if:address,null',
    		'long' => 'numeric|required_if:address,null',
    		'start_time' => 'date_format:H:i',
    		'end_time' => 'date_format:H:i|after:start_time',
    		'description' => 'string',
            // 'type' => 'required|in:user,salon'
            // 'days' => 'in:sunday,monday,tuesday,wednesday,thursday,friday,saturday'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $user = User::where('uuid', $request->user_uuid)->first();
        if(!$user)
            return sendError("user Not Found",[]);

        DB::beginTransaction();     
        try {

	        if('user'== $user->type)
	        	$user->name = $request->name??$user->name;
	        else{

	        	$user->name = $request->name??$user->name;
	        	$user->address = $request->address??$user->address;
	        	$user->lat = $request->lat??$user->lat;
	        	$user->long = $request->long??$user->long;
	        	$user->start_time = $request->start_time??$user->start_time;
	        	$user->end_time = $request->end_time??$user->end_time;
	        	$user->description = $request->description??$user->description;
	        }

	        $user->save();
	        $data['user'] = $user; 
            $daysSaved = [];
	        if(!$user){

	    		DB::rollBack();
	        	return sendError("Internal Server Error",[]);
	        }
            if($request->days){
                $days = array_unique(json_decode($request->days));
                $database_days =  Day::where('salon_id',$user->id)->pluck('day')->toArray();
                $days_to_add = array_diff($days,$database_days);
                $days_to_delete = array_diff($database_days,$days);
                
                foreach($days_to_delete as $day){
                    $day_to_delete = Day::where('salon_id',$user->id)->where('day',$day)->delete();
                } 
                
                foreach ($days_to_add as $day) {
                    $day_obj = new Day;
                    $day_obj->uuid = str::uuid();
                    $day_obj->salon_id = $user->id;
                    $day_obj->day = $day;
                    $day_obj->save();
                    $daysSaved[] = $day_obj->day;
                }
            }

            $data['user']['days'] = $daysSaved;
        	DB::commit();
        	return sendSuccess('User updated',$data);
        	
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

    public function getUser(Request $request){
        $validator = Validator::make($request->all(), [
            'user_uuid' => 'exists:users,uuid',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        } 

        $user = User::where('id',$request->user_uuid??$request->user()->id)
            ->with(['days'])->first();

        return sendSuccess('User Data',$user);
    }
}
