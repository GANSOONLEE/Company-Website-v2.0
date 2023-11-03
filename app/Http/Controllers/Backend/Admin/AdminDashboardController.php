<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Pusher\Pusher;

class AdminDashboardController extends Controller{

    public function adminDashboard(){

        return view('backend.admin.dashboard');
    }

}