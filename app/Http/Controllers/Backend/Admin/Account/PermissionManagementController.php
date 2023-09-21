<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;

class PermissionManagementController extends Controller{

    public function permissionManagement(){

        //
        $roles = Role::orderBy('weight', 'asc')
            ->get();

        $userRoleWeight = auth()->user()->getRoleEntity()->weight;

        $roleData = [];
        foreach($roles as $role){
            if($role->weight < $userRoleWeight){
                $roleData[] = $role;
            }
        }

        $permissionsData = [];
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $permissionsData[] = $permission->name;
        }

        return view('backend.admin.account.permission-management', compact('roleData', 'permissionsData'));
    }

}