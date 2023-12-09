<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Request\CreateUserRequest;
use App\Domains\Auth\Services\UserService;


use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;

class UserController
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * url: admin/user/
     * method: get
     * name: backend.admin.user.index
     * 
     * @return \Illuminate\View\View;
     */
    public function index(): \Illuminate\View\View
    {
        return view('backend.admin.auth.user-management-center');
    }

    /**
     * url: admin/user/create
     * method: get
     * name: backend.admin.user.create
     * 
     * @return mixed
     */

    public function create()
    {
        return view('backend.admin.auth.user.create');
    }

    /**
     * url: admin/user/management
     * method: get
     * name: backend.admin.user.management
     * @param int|bool $page
     * 
     * @return mixed
     */

    public function management(Request $request, int|bool $page = false): mixed
    {
        $recordPerPage = $request->recordPerPage;
        $users = $this->userService->getByPage($page);
        return view('backend.admin.auth.user.management', compact('users', 'page'));
    }

    /**
     * url: admin/user/permission
     * method: get
     * name: backend.admin.user.permission
     * 
     * @return mixed
     */

    public function permission()
    {
        return view('backend.admin.auth.user.permission');
    }

    /**
     * url: admin/user/ban
     * method: get
     * name: backend.admin.user.ban
     * 
     * @return mixed
     */

    public function ban()
    {
        return view('backend.admin.auth.user.ban');
    }

    /**
     * url: admin/user/
     * method: post
     * name: backend.admin.user.store
     * 
     * @param CreateUserRequest $request
     * 
     * @return mixed
     * @throws \Throwable
     */
    public function store(CreateUserRequest $request): mixed
    {
        $this->userService->store($request->validated());
        
        return redirect()->back();
    }

    /**
     * url: admin/user/edit
     * method: get
     * name: backend.admin.user.edit
     * 
     * @param User $user
     * 
     * @return mixed
     */
    public function edit(){

    }

    /**
     * url: admin/user/{user}
     * method: patch
     * name: backend.admin.user.update
     */
    public function update(Request $request){

    }

    /**
     * url: admin/user/{user}
     * method: delete
     * name: backend.admin.user.delete
     * @param $user
     */
    public function delete($user){

    }

    /**
     * url: admin/user/deleted-user/{user}
     * method: delete
     * name: backend.admin.user.destroy
     * @param $user
     */
    public function destroy($user){

    }


}