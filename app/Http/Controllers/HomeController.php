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
        $salonCntrl = $this->salonApiCntrl;
        $apiResponse = $salonCntrl->getSalon($request)->getData();
        if($apiResponse->status)
        {
            $allSalons = $apiResponse->data;


            return view('Home.index', ['allSalons'=>$allSalons]);
        }

        // dd('opk');

        // Auth::logout();

        // return redirect()->route('weblogin');

    //     return view('Home.index');

    }
}
