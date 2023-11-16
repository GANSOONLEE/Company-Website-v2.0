<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Pusher\Pusher;

require_once app_path('Helpers/Global/DataFlowHelper.php');

class AdminDashboardController extends Controller{

    public function adminDashboard(){
        return view('backend.admin.dashboard');
    }

}