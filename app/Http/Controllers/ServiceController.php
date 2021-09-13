<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Models\Offer;
use App\Models\Service;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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
            'status'     => 'in:active,in-active',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $result = $this->userService->checkSalon($request);
        if(!$result['status'])
            return sendError($result['message'] ,$result['data']);
        $salon = $result['data'];

        $services = Service::orderBy('created_at', 'DESC')->where('salon_id',$salon->id);

        if(isset($request->status))
            $services->where('status',$request->status);

        if(isset($request->limit))
            $services->offset($request->offset??0)->limit($request->limit);

        $services = $services->with('offer')->get();

        if(0 == $services->count())
            return sendError('No Service Found',$services);

        return sendSuccess('Services',$services);
    }

    public function updateService(Request $request){

        $validator = Validator::make($request->all(), [
            'salon_uuid'   => 'required_without:service_uuid|exists:users,uuid',
            'service_uuid' => 'required_without:salon_uuid|exists:services,uuid',
            'name'         => 'string|required_with:salon_uuid',
            'price'        => 'numeric|required_with:salon_uuid',
            'status'       => 'in:active,in-active'
            'discount'     => 'numeric',
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
            
            $service->name = $request->name ?? $service->name;
            $service->price = (int)($request->price ?? $service->price);
            $service->salon_id = $service->salon_id ?? $salon->id;
            $service->status = $request->status ?? $service->status ?? 'active';
            $service->save();




            // if($service->save())){
            //     $offer = Offer::where('service_id',$service->id)->first();
            //     if(NULL == $offer){
            //         $offer = new Offer;
            //         $offer->uuid = str::uuid();
            //     }

            //     $offer->service_id = $service->id;
            //     $offer->discount   = $request->discount;
            //     $offer->status     = $request->status;
            //     $offer->price      = ($request->discount/100) * $service->price;
            // }

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

    public function serviceOff(Request $request){

        $validator = Validator::make($request->all(), [
            'service_uuid' => 'required|exists:services,uuid',
            'discount'     => 'required|min:1',
            'status'       => 'required|in:active,in-active',
        ]);

        if ($validator->fails()) {

            $data['validation_error'] = $validator->getMessageBag();
            return sendError($validator->errors()->all()[0], $data);
        }

        $service = Service::where('uuid',$request->service_uuid)->first();
        if(NULL == $service)
            return sendError('Invalid Service',[]);

        $offer = Offer::where('service_id',$service->id)->first();
        if(NULL == $offer){
            $offer = new Offer;
            $offer->uuid = str::uuid();
        }

        $offer->service_id = $service->id;
        $offer->discount   = $request->discount;
        $offer->status     = $request->status;
        $offer->price      = ($request->discount/100) * $service->price;

        $offer->save();

        $service = Service::where('uuid',$request->service_uuid)->with('offer')->first();

        return sendSuccess('Discount Added',$service);


    }
}
