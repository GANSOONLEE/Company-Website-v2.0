<?php

namespace App\Domains\Auth\Http\Controllers;

// Request
use App\Domains\Auth\Request\CreateUserRequest;
use App\Domains\Auth\Request\UpdateUserRequest;
use Illuminate\Http\Request;

// Service
use App\Domains\Auth\Services\UserService;

// Model
use App\Domains\Auth\Models\User;

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
     * @param int $page
     * 
     * @return mixed
     */

    public function management(Request $request, int $page = 10): mixed
    {
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
     * url: admin/user/get/{userID}
     * method: get
     * name: backend.admin.user.get
     * 
     * @param string $email
     * 
     * @return mixed
     */

    public function get(string $email)
    {
        return $this->userService->getUser($email);
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
    public function edit()
    {

    }

    /**
     * url: admin/user/{user}
     * method: patch
     * name: backend.admin.user.update
     * @param UpdateUserRequest $request
     * 
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request)
    {
        $this->userService->update($request->validated());
        
        return redirect()->back();
    }

    /**
     * url: admin/user/{user}
     * method: delete
     * name: backend.admin.user.delete
     * @param $user
     */
    public function delete($user)
    {

    }

    /**
     * url: admin/user/deleted-user/{user}
     * method: delete
     * name: backend.admin.user.destroy
     * @param $user
     */
    public function destroy($user)
    {

    }

    /*
     | ----------------------------------------------------------------
     |
     |                            User 用戶
     |
     | ----------------------------------------------------------------
     */
    public function profile()
    {
        return view('backend.user.profile', ["user" => auth()->user()]);
    }

}