<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Domains\Auth\Models\User;

class UserManagementController extends Controller{

    public function userManagement(){

        // getData
        $userData = auth()->user()->getRoleWithWeight();

        $roleData = [];
        $userRoleWeight = auth()->user()->roles()->weight;

        $roles = Role::orderBy('weight', 'desc')->get();
        foreach($roles as $role){
            if($role->weight < $userRoleWeight){
                $roleData[] = $role->name; 
            }
        }

        return view('backend.admin.account.user-management', compact('userData', 'roleData'));
    }

}