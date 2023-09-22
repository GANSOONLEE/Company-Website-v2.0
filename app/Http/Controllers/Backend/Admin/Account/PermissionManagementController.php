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

        $permissions = Permission::orderBy('permission_category', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $permissionsData = [];

        foreach ($permissions as $permission) {
            $category = $permission->permission_category;

            if (!isset($permissionsData[$category])) {
                $permissionsData[$category] = [];
            }

            $permissionsData[$category][] = $permission->name;
        }

        return view('backend.admin.account.permission-management', compact('roleData', 'permissionsData'));
    }

}