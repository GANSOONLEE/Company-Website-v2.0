<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Services\PermissionService;

use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\Permission;

use Illuminate\Http\Request;

class PermissionController
{

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * url: admin/permission/
     * method: get
     * name: backend.admin.account.index
     * 
     * @return \Illuminate\View\View;
     */
    public function index(): \Illuminate\View\View
    {
        return view('backend.admin.auth.permission-management-center');
    }

    /**
     * url: admin/permission/management
     * method: get
     * name: backend.admin.permission.management
     * 
     * @return mixed
     */

    public function management()
    {
        return view('backend.admin.auth.permission.management');
    }

    /**
     * url: admin/permission/management
     * method: patch
     * @param Request $request
     * @return mixed
     */

    public function managementPage(Request $request)
    {
        return redirect()->route('backend.admin.permission.edit', ['role_name' => $request->role]);
    }


    /**
     * url: admin/permission/edit/{role_name}
     * method: get
     * name: backend.admin.permission.edit
     * @param string $role_name
     * @return mixed
     */

    public function edit(string $role_name)
    {
        $role = Role::where('name', $role_name)
                        ->first();

        $permissionsChecked = $role->getAllPermissions();

        return view('backend.admin.auth.permission.management', compact('permissionsChecked', 'role'));
    }
    
    /**
     * url: admin/permission/{permission}
     * method: patch
     * name: backend.admin.permission.update
     */
    public function update(Request $request){

    }

}