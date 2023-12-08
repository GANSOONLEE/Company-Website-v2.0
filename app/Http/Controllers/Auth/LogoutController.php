<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller{

    public function logout(){

        $user = Auth::user();

        Cookie::forget("remember_token");
        
        Auth::logout();
        session()->flush();

        return redirect()->route('frontend.home');
    }

}