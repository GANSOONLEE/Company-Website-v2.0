<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserResetPasswordController extends Controller{

    public function userResetPassword(Request $request){
        return redirect()->route('backend.user.data.user');
    }

}