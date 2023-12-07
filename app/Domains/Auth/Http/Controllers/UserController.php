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
     * name: backend.admin.account.index
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
     * name: backend.admin.account.create
     * 
     * @return mixed
     */

    public function create()
    {
        return view('backend.admin.auth.create');
    }

    /**
     * url: admin/user/
     * method: post
     * name: backend.admin.account.store
     * 
     * @param CreateUserRequest $request
     * 
     * @return mixed
     * @throws \Throwable
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->userService->store($request->validated());

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