<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller{

    public function forgetPassword(){
        return view('auth.forget-password');
    }

}