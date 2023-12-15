<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Services\PermissionService;

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
     * url: admin/permission/create
     * method: get
     * name: backend.admin.account.create
     * 
     * @return mixed
     */

    // public function create()
    // {
    //     return view('backend.admin.permission.create');
    // }

    /**
     * url: admin/permission/edit
     * method: get
     * name: backend.admin.permission.edit
     * 
     * @param Permission $permission
     * 
     * @return mixed
     */
    public function edit(){

    }

    /**
     * url: admin/permission/{permission}
     * method: patch
     * name: backend.admin.permission.update
     */
    public function update(Request $request){

    }

}