<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Twilio\Rest\Client;

class TwilioController extends Controller
{
	private $client;

	function __construct(){

		// test 
       	// $this->client = new Client('ACa97f0315b8e8a09191eee4390d8e7cd3','fcf71c367f5757630b445413aa772e29','P5CVKyXZDo9IdQMfN3tVY7tDrdmyG1rl');
    	//    live 
		$this->client = new Client('AC7c61cd1266aabea264e291483fe75161','2526a33dd642d54620ba6bee6a9a0dec','P5CVKyXZDo9IdQMfN3tVY7tDrdmyG1rl');
    }

    public function sendMessage($number, $code){

    	try {
    		$apiResponse = $this->client->messages->create(
		  		(int)$number, // Text this number
		  		[
		    		'from' => (int)'+14842902255', // From a Glitterups client
		    		'body' => $code
		  		]
			);
			return $apiResponse;

    	} catch (Exception $e) {
    		return sendError($e->getMessage(), []);
    	}




    }

    /**
     * Valiate Phone Number
     *
     * @param integer $number
     * @param integer $countrycode
     *
     * @return void
     */
    public function isValidNumber($phone_code, $phone_number){
		// dd($phone_code,$phone_number);
    	try {
    		$apiResponse = $this->client->lookups->v1->phoneNumbers($phone_code.$phone_number)->fetch(["countryCode" => $phone_code.$phone_number]);
			// dd($apiResponse);
    	} catch (\Exception $e) {
    		return false;
    	}

        return $apiResponse;

    }

}