<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
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

    public function checkAvailableSlots(Request $request,$salon){

        $startTime = Carbon::parse($salon->start_time)->modify('-30 minutes');
        $endTime = Carbon::parse($salon->end_time);
        $date = Carbon::parse($request->date);

        while ($startTime->modify('+30 minutes') < $endTime) {
            $salon_time_slots[] = $startTime->format('H:i:s');
        }

        $booked_appointments = Appointment::where('salon_id',$salon->id)->where('date',$date)->pluck('start_time')->toArray();
        $available_appointment_slots = array_values(array_diff($salon_time_slots,$booked_appointments));

        return internalSuccess('available Appointments slots',$available_appointment_slots);
    }
    public function checkAvailableDate(Request $request,$salon){

        $days = $salon->days->pluck('day')->toArray();
        $date_day = explode(' ',strtolower(Carbon::parse($request->date)->format('l')));
        $available_day = array_intersect($days,$date_day);
        if(null == $available_day)
            return internalError('Date Not Available',$available_day);

        return internalSuccess('Available Date',$available_day);
    }

}
