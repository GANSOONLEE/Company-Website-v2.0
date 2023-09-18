<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;

class RoleManagementController extends Controller{

    public function roleManagement(){
        return view('backend.admin.account.role-management');
    }

}