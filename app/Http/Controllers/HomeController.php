<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;

class HomeController extends Controller
{

    private $salonApiCntrl;
    private $salonApiServiceCntrl;
    private $salonApiAppointmentCntrl;

    public function __construct(UserController $salonApiCntrl, ServiceController $salonApiServiceCntrl, AppointmentController $salonApiAppointmentCntrl)
    {
        $this->salonApiCntrl = $salonApiCntrl;
        $this->salonApiServiceCntrl = $salonApiServiceCntrl;
        $this->salonApiAppointmentCntrl = $salonApiAppointmentCntrl;
    }

    public function index(Request $request)
    {
        // dd($request->all());
        // dd(Auth::id());
        
        $user = Auth::user();
        if (isset($user) && ($user != null)) {
            if (($user->type == 'salon') || ($user->type == 'salon')) {
                return redirect()->route('profileSetting', [$user->uuid]);
            }
        }
        //     if ($user->type == 'admin') {
        //         return redirect('admin/show');
        //     } else
                //     } elseif ($user->type == 'user') {
        //         return redirect()->route('profileSetting', [$user->uuid]);
        //     } else {
        //         return redirect('/');
        //     }
        // }

        $apiResponse1 = '';
        $apiResponse2 = '';

        if (isset($request->lat) && ('' !== $request->lat) || isset($request->long) && ('' !== $request->long)) {
            // dd($request->lat, $request->long);
            $request->merge([
                'lat' => $request->lat,
                'long' => $request->long
            ]);
            // dd($request->all());
            $salonCntrl = $this->salonApiCntrl;
            // $apiResponse1 = $salonCntrl->getSalon($request)->getData();
            $apiResponse1 = $salonCntrl->getAllSalon($request);
            // dd($apiResponse1);

            return sendSuccess('Salon near by list', $apiResponse1);
            // return view('index', ['salonsNearByMe',$apiResponse1->data, 'book_salon' => 0]);
            //return view('Home.index', ['salonsNearByMe'=>$apiResponse1 , 'book_salon' => 0]);
            // return \Response::json( $apiResponse1 );
        }

        $salonCntrl = $this->salonApiCntrl;
        $request->merge([
            'popular' => '1'
        ]);



        $apiResponse2 = $salonCntrl->getSalon($request)->getData();
        // dd($apiResponse1);
        // dd($apiResponse1, $apiResponse2);


        // if($apiResponse1->status ?? true || $apiResponse2->status)
        if ($apiResponse2->status) {
            // $salonsNearByMe = $apiResponse1->data ?? null;
            // if(null == $salonsNearByMe)
            // {
            //     $salonsNearByMe = $apiResponse2->data;
            // }
            $allSalons = $apiResponse2->data;
            // dd($allSalons);

            // dd($allSalons, $salonsNearByMe);
            return view('Home.index', ['allSalons' => $allSalons, 'book_salon' => 0]);
        }



        // dd('opk');

        // Auth::logout();

        // return redirect()->route('weblogin');

        //     return view('Home.index');

    }

    public function getNearbySaloons(Request $request)
    {
        return view('Home.index', ['salonsNearByMe' => $request, 'book_salon' => 0]);
    }



    public function allSalons(Request $request)
    {
        $apiResponse1 = '';
        $apiResponse2 = '';

        if (isset($request->lat) && ('' !== $request->lat) || isset($request->long) && ('' !== $request->long)) {
            // dd($request->lat, $request->long);
            $request->merge([
                'lat' => $request->lat,
                'long' => $request->long
            ]);
            // dd($request->all());
            $salonCntrl = $this->salonApiCntrl;
            $apiResponse1 = $salonCntrl->getSalon($request)->getData();
        }
        $salonCntrl = $this->salonApiCntrl;
        $request->merge([
            'popular' => '1'
        ]);


        // dd($apiResponse1);

        $apiResponse2 = $salonCntrl->getSalon($request)->getData();
        if ($apiResponse1->status ?? true || $apiResponse2->status) {
            $salonsNearByMe = $apiResponse1->data ?? null;
            if (null == $salonsNearByMe) {
                $salonsNearByMe = $apiResponse2->data;
            }
            $allSalons = $apiResponse2->data;

            // dd($allSalons, $salonsNearByMe);
            return view('Home.get_all_salons', ['allSalons' => $allSalons, 'allSalons' => $salonsNearByMe, 'book_salon' => 0]);
        }
    }


    public function bookingSalon($uuid, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $request->merge([
                'user_uuid' => $uuid,
            ]);

            $userCntrl = $this->salonApiCntrl;
            $apiResponse = $userCntrl->getUser($request)->getData();
            if ($apiResponse->status) {
                $salon_available_days = $apiResponse->data;
                $salon_uuid = $salon_available_days->uuid;
                $salon_days = $salon_available_days->days;
                return view('Home.booking', ['salon_uuid' => $salon_uuid, 'salon_days' => $salon_days,  'book_salon' => 1]);
            }
        }
    }


    public function bookingSalonServices($uuid = null, Request $request)
    {
        if ($request->getMethod() == 'GET') {
            // dd(Auth::user()->uuid);

            $request->merge([
                'salon_uuid' => $uuid,
            ]);

            // if(Auth::user())
            // {
            //     $request->merge([
            //         'user_uuid'=> Auth::user()->uuid,
            //     ]);
            //     $appointmentCntrl = $this->salonApiAppointmentCntrl;
            //     $apiResponseAppointment = $appointmentCntrl->updateAppointment($request)->getData();

            //     $userCntrl = $this->salonApiServiceCntrl;
            //     $apiResponse = $userCntrl->getService($request)->getData();


            //     if($apiResponseAppointment->status && $apiResponse->status)
            //     {
            //         $saloon_service = $apiResponse->data;
            //         $add_appointment = $apiResponseAppointment->data;
            //         return view('Home.booking_salon_services', ['saloon_service' => $saloon_service, 'add_appointment' => $add_appointment , 'book_salon' => 1]);

            //     }
            // }


            $userCntrl = $this->salonApiServiceCntrl;
            $apiResponse = $userCntrl->getService($request)->getData();
            if ($apiResponse->status) {
                $saloon_service = $apiResponse->data;
                return view('Home.booking_salon_services', ['saloon_service' => $saloon_service,  'book_salon' => 1, 'salon_uuid' => $uuid]);
            } else {
                return redirect()->back()->with('message', 'No Service Found')->with('type', 'error');
            }
        }
    }


    public function bookingTime(Request $request)
    {

        $availableAppointment = $this->salonApiAppointmentCntrl;
        $apiResponse = $availableAppointment->availableAppointments($request)->getData();
        // dd($apiResponse);
        if ($apiResponse->status) {
            return sendSuccess('get available Appointments successfully', $apiResponse->data);
        }
        return sendError('Error', []);
    }

    public function bookService(Request $request)
    {
        // dd($request->all());

        $availableAppointment = $this->salonApiAppointmentCntrl;
        $apiResponse = $availableAppointment->updateAppointment($request)->getData();
        // dd($apiResponse);

        if ($apiResponse->status) {
            return sendSuccess('Appointment booked successfully', $apiResponse->data);
        }
        return sendError('Error', []);
    }



    public function aboutUsUser()
    {
        return view('Home.aboutus', ['book_salon' => 1]);
    }

    public function privacy()
    {
        return view('Home.privacy', ['book_salon' => 1,]);
    }
    public function termsCondition()
    {
        return view('Home.terms_conditions', ['book_salon' => 1,]);
    }
}
