<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class UserManagementController extends Controller{

    public function userManagement(){

        // getData
        $userData = User::join('users_roles', 'users.email', '=', 'users_roles.user_email')
            ->join('roles', 'users_roles.role_name', '=', 'roles.name')
            ->select('users.*', 'roles.weight')
            ->orderBy('roles.weight', 'desc')
            ->get();

        $roles = Role::all();

        $roleData = [];

        $userRoleWeight = auth()->user()->getRoleEntity()->weight;

        foreach($roles as $role){
            if($role->weight < $userRoleWeight){
                $roleData[] = $role->name; 
            }
        }

        return view('backend.admin.account.user-management', compact('userData', 'roleData'));
    }

}