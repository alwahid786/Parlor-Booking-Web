<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class HomeController extends Controller
{

    private $salonApiCntrl;

    public function __construct(UserController $salonApiCntrl)
    {
        $salonApiCntrl = $this->salonApiCntrl;
    }

    public function index(Request $request)
    {
        $salonCntrl = $this->salonApiCntrl;
        // $apiResponse = $salonCntrl->getSalon($request)->getData();
        // if($apiResponse->status)
        // {
        //     $allSalons = $apiResponse->data;

        // }
        return view('Home.index');
    }
}
