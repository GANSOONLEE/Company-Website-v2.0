<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Request\LoginRequest;
use App\Domains\Auth\Request\DestroyRequest;
use App\Domains\Auth\Services\LoginService;
use App\Domains\Auth\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController
{

    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * url: auth/login
     * method: get
     * name: auth.login.index
     * 
     * @return \Illuminate\View\View;
     */
    public function index(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    /**
     * url: auth/login
     * method: post
     * name: auth.login.valid
     * 
     * @return mixed
     */
    public function valid(LoginRequest $request): mixed
    {
        $user = $this->loginService->store($request->validated());

        return $user instanceof User ?
            redirect()->route('frontend.home') :
            redirect()->back() ;
        
    }

    /**
     * url: auth/logout
     * method: get
     * name: auth.logout
     * 
     * @return mixed
     */
    public function logout(): mixed
    {
        Auth::logout();
        return redirect()->route('frontend.home');
    }

    /**
     * url: auth/destroy
     * method: delete
     * name: auth.destroy
     * 
     * @return mixed
     */
    public function destroy(DestroyRequest $request): mixed
    {
        
        // get current user account
        $user = auth()->user();
        $this->loginService->destroy($user, $request->validated());

        Auth::logout();
        return redirect()->route('frontend.home');
    }

}