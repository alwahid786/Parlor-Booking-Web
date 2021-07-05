<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserService 
{
	private $relations = [];

	public function checkSalon(Request $request)
	{
        $model = User::where('uuid', $request->salon_uuid)
        	->where('type','salon')
        	->first();

    	if(null == $model){
    		return internalError('Salon not found',"",404);
    	}

    	return internalSuccess('Salon Data',$model);
	}

    public function checkUser(Request $request)
    {
        $model = User::where('uuid', $request->user_uuid)
            ->where('type','user')
            ->first();

        if(null == $model){
            return internalError('User not found',"",404);
        }

        return internalSuccess('User Data',$model);
    }

}
