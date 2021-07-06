<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Services\UserService;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ServiceController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getService(Request $request){

        $validator = Validator::make($request->all(), [
            'salon_uuid' => 'required|exists:users,uuid',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $result = $this->userService->checkSalon($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $salon = $result['data'];

        $services = Service::orderBy('created_at', 'DESC')->where('salon_id',$salon->id)->get();


        if(0 == $services->count())
            return sendError('No Service Found',$services);

        return sendSuccess('Services',$services);
    }

    public function updateService(Request $request){

        $validator = Validator::make($request->all(), [
            'salon_uuid' => 'required_without:service_uuid|exists:users,uuid',
            'service_uuid' => 'required_without:salon_uuid|exists:services,uuid',
            'name' => 'string|required_with:salon_uuid',
            'price' => 'numeric|required_with:salon_uuid',
            'status' => 'in:active,in-active'
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        if(isset($request->service_uuid)){

            $service = Service::where('uuid',$request->service_uuid)->first();
        }
        else{
            $service =  new Service;
            $service->uuid = str::uuid();
        }

        if(isset($request->salon_uuid)){

            $result = $this->userService->checkSalon($request);
            if(!$result['status'])
                return sendError($result['message'] ,$result['data']);
            $salon = $result['data'];
        }

        DB::beginTransaction();
        try{
            
            $service->name = $request->name??$service->name;
            $service->price = (int)($request->price??$service->price);
            $service->salon_id = $service->salon_id??$salon->id;
            $service->status = $request->status??$service->status??'active';
            $service->save();

            if(!$service->save()){

                DB::rollBack();
                return sendError("Internal Server Error",[]);
            }

            DB::Commit();
            return sendSuccess('Service Saved',$service);
        }
        catch (Exception $e) {
            DB::rollBack();
            return sendError($e->getMessage(), $e->getTrace());
        }

    }
}
