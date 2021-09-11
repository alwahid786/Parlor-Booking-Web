<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Http\Controllers\NotificationController;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReviewController extends Controller
{

	private $userService;
    
    public function __construct(UserService $userService,NotificationController $NotificationController)
    {
        $this->userService = $userService;
        $this->NotificationController = $NotificationController;
    }

    public function review(Request $request){

    	$validator = Validator::make($request->all(), [
            'appointment_uuid' => 'required|exists:appointments,uuid',

            'review'           => 'required|string',
            'rating'           => 'required|numeric|min:1|max:5',

            'user_uuid'        => 'exists:users,uuid',
            'salon_uuid'       => 'exists:users,uuid',
            'service_uuid'     => 'exists:services,uuid',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        //Check Salon
        if(isset($request->salon_uuid)){

	        $result = $this->userService->checkSalon($request);
	        if(!$result['status'])
	            return sendError($result['message'] ,$result['data']);
	        $salon = $result['data'];
        }

        //Check User
        if(isset($request->user_uuid)){

	        $result = $this->userService->checkUser($request);
	        if(!$result['status'])
	            return sendError($result['message'] ,$result['data']);
	        $user = $result['data'];
        }

        //Check Appointment
        if(isset($request->appointment_uuid)){

	        $appointment = Appointment::where('uuid',$request->appointment_uuid)->first();
	        if(NULL == $appointment)
	        	return sendError('Invalid Appointment',[]);
        }

        //Check Service
        if(isset($request->services_uuid)){

	        $service = service::where('uuid',$request->service_uuid)->first();
	        if(NULL == $service)
	        	return sendError('Invalid Service',[]);
        }

        try {

        	$review = new Review;

	        $review->uuid = str::uuid();
	        $review->appointment_id = $appointment->id ?? NULL;
	        $review->salon_id       = $salon->id ?? $appointment->salon->id ?? NULL;
	        $review->service_id     = $service->id ?? NULL;
	        $review->user_id        = $user->id ?? $request->User()->id;
	        $review->review         = $request->review;
	        $review->rating         = $request->rating;

			$review->save();	 
			DB::Commit();

			$data['review'] = Review::find($review->id);

			return sendSuccess('Reviewed',$data);


        } catch(Exception $e) {
            DB::rollBack();
            return sendError($e->getMessage(), $e->getTrace());
        }

    }
}
