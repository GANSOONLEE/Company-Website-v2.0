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
     * name: backend.admin.role.index
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
     * name: backend.admin.role.create
     * 
     * @return mixed
     */
    public function create()
    {
        return view('backend.admin.auth.role.create');
    }

    /**
     * url: admin/role/management
     * method: get
     * name: backend.admin.role.management
     * 
     * @return mixed
     */
    public function management()
    {
        return view('backend.admin.auth.role.management');
    }

    /**
     * url: admin/role/get
     * method: get
     * name: backend.admin.role.get
     * 
     * @return mixed
     */
    public function get(string $id)
    {
        return $this->roleService->getRole($id);
    }

    /**
     * url: admin/role/
     * method: post
     * name: backend.admin.role.store
     * 
     * @param CreateRoleRequest $request
     * 
     * @return mixed
     * @throws \Throwable
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleService->store($request->validated());

        return redirect()->back()->with('success','Role created successfully');
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
        $this->roleService->update($request->toArray());
        return redirect()->back()->with('success', 'Role updated successfully');
    }

    /**
     * Restore soft deleted user
     * url: admin/user/restore/{id}
     * method: patch
     * name: backend.admin.user.restore\
     * @param string $id
     */
    public function restore(string $id)
    {
        $user = Role::where('id', $id)->onlyTrashed()->first();
        $user->restore();

        return redirect()->back()->with('success', 'Role restore successfully');
    }

    /**
     * url: admin/role/{role}
     * method: delete
     * name: backend.admin.role.delete
     * @param $id
     */
    public function delete($id){
        // Soft delete the user
        $user = Role::where('id', $id)->first();
        $user->delete();

        return redirect()->back()->with('success', 'Role deleted successfully');
    }

    /**
     * url: admin/role/deleted-role/{role}
     * method: delete
     * name: backend.admin.role.destroy
     * @param $id
     */
    public function destroy($id){
        $user = Role::where('id', $id)->onlyTrashed()->first();
        $this->roleService->destroy($user);

        return redirect()->back()->with('success', 'Role force delete successfully');
    }


}