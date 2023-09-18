<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;

class PermissionManagementController extends Controller{

    public function permissionManagement(){
        return view('backend.admin.account.permission-management');
    }

}