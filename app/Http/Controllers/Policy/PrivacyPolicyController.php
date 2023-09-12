<?php

namespace App\Http\Controllers\Policy;

use App\Http\Controllers\Controller;

class PrivacyPolicyController extends Controller{

    public function privacyPolicy(){
        return view('policy.privacy-policy');
    }
}