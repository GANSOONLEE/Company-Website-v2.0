<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Request\CreateRoleRequest;
use App\Domains\Auth\Services\RoleService;

use App\Domains\Auth\Models\Role;
use Illuminate\Http\Request;

class RoleController
{

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * url: admin/role/
     * method: get
     * name: backend.admin.account.index
     * 
     * @return \Illuminate\View\View;
     */
    public function index(): \Illuminate\View\View
    {
        return view('backend.admin.auth.role-management-center');
    }

    /**
     * url: admin/role/create
     * method: get
     * name: backend.admin.account.create
     * 
     * @return mixed
     */

    public function create()
    {
        return view('backend.admin.auth.create');
    }

    /**
     * url: admin/role/
     * method: post
     * name: backend.admin.account.store
     * 
     * @param CreateRoleRequest $request
     * 
     * @return mixed
     * @throws \Throwable
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleService->store($request->validated());

        return redirect()->back();
    }

    /**
     * url: admin/role/edit
     * method: get
     * name: backend.admin.role.edit
     * 
     * @param Role $role
     * 
     * @return mixed
     */
    public function edit(){

    }

    /**
     * url: admin/role/{role}
     * method: patch
     * name: backend.admin.role.update
     */
    public function update(Request $request){

    }

    /**
     * url: admin/role/{role}
     * method: delete
     * name: backend.admin.role.delete
     * @param $role
     */
    public function delete($role){

    }

    /**
     * url: admin/role/deleted-role/{role}
     * method: delete
     * name: backend.admin.role.destroy
     * @param $role
     */
    public function destroy($role){

    }


}