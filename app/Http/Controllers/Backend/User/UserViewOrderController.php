<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserViewOrderController extends Controller
{
    public function userViewOrder(){
        return view('backend.user.order');
    }
}
