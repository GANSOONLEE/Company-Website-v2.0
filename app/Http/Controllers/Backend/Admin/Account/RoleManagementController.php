<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleManagementController extends Controller{

    public function roleManagement(){

        $roleData = Role::orderBy('weight', 'asc')
            ->get();

        return view('backend.admin.account.role-management', compact('roleData'));
    }

}