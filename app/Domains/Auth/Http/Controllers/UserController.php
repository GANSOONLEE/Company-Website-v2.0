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
     * @return mixed
     */

    public function management(Request $request): mixed
    {
        $users = User::with('roles')
            ->withTrashed()
            ->leftJoin('users_roles', 'users.email', '=', 'users_roles.user_email')
            ->leftJoin('roles', 'users_roles.role_name', '=', 'roles.name')
            ->select('users.*', 'roles.name as roles_name')
            ->orderBy('roles.weight', 'asc')
            ->paginate(5);

        return view('backend.admin.auth.user.management', compact('users'));
    }

    /**
     * url: admin/user/search
     * method: get
     * name: backend.admin.user.search
     * @return mixed
     */

    public function search(Request $request): mixed
    {
        $searchTerm = $request->q;
        if($searchTerm === null){
            return redirect()->route('backend.admin.user.management');
        }

        $users = $this->userService->search($searchTerm);
        return view('backend.admin.auth.user.management', compact('users'));
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
     * Restore soft deleted user
     * url: admin/user/restore/{id}
     * method: patch
     * name: backend.admin.user.restore\
     * @param string $id
     */
    public function restore(string $id)
    {
        $user = User::where('id', $id)->onlyTrashed()->first();
        $user->restore();

        return redirect()->back()->with('success', 'User restore successfully');
    }

    /**
     * url: admin/user/{user}
     * method: delete
     * name: backend.admin.user.delete
     * @param string $id
     */
    public function delete(string $id)
    {
        // Soft delete the user
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
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