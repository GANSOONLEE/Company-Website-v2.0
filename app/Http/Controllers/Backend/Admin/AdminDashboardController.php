<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller{

    public function adminDashboard(){
        return view('backend.admin.dashboard');
    }

}