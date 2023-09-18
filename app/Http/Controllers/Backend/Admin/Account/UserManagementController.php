<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserManagementController extends Controller{

    public function userManagement(){

        $userData = User::all();

        return view('backend.admin.account.user-management', compact('userData'));
    }

}