<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class HomeController extends Controller
{

    private $salonApiCntrl;


    public function __construct(UserController $salonApiCntrl)
    {
        $this->salonApiCntrl = $salonApiCntrl;
    }

    public function index(Request $request)
    {
        // dd($request->all());

        $apiResponse1 = '';
        $apiResponse2 = '';

        if(isset($request->lat) && ('' !== $request->lat) || isset($request->long) && ('' !== $request->long))
        {
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
        if($apiResponse1->status ?? true || $apiResponse2->status)
        {
            $salonsNearByMe = $apiResponse1->data ?? null;
            if(null == $salonsNearByMe)
            {
                $salonsNearByMe = $apiResponse2->data;
            }
            $allSalons = $apiResponse2->data;

            // dd($allSalons, $salonsNearByMe);
            return view('Home.index', ['allSalons'=>$allSalons, 'salonsNearByMe'=>$salonsNearByMe , 'book_salon' => 0]);
        }



        // dd('opk');

        // Auth::logout();

        // return redirect()->route('weblogin');

    //     return view('Home.index');

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


    public function bookingSalon($uuid , Request $request)
    {
        if($request->getMethod() == 'GET')
        {
            $request->merge([
                'user_uuid' => $uuid,
            ]);

            $userCntrl = $this->salonApiCntrl;
            $apiResponse = $userCntrl->getUser($request)->getData();
            if ($apiResponse->status) {
                $saloon_available_days = $apiResponse->data;
                $salon_days = $saloon_available_days->days;
                return view('Home.booking', ['salon_days'=>$salon_days,  'book_salon' => 1]);
            }
        }
    }
}
