<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function privacyPolicyVendors(){
        return view('Cms.privacy_policy_vendors');
    }

    public function privacyPolicyCustomer(){
        return view('Cms.privacy_policy_customer');
    }

    public function termsConditionsVendors(){
        return view('Cms.terms_conditions_vendors');
    }

    public function termsConditionsCustomer(){
        return view('Cms.terms_conditions_customer');
    }

    public function aboutUs(){
        return view('Cms.about_us');
    }

}
