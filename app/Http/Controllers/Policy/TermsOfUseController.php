<?php

namespace App\Http\Controllers\Policy;

use App\Http\Controllers\Controller;

class TermsOfUseController extends Controller{

    public function termsOfUse(){
        return view('policy.terms-of-use');
    }
}