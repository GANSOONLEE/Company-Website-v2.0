<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Request\LoginRequest;
use App\Domains\Auth\Services\LoginService;

use App\Domains\Auth\Models\User;
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
     * name: auth.login.store
     * 
     * @return mixed
     */
    public function store(LoginRequest $request): mixed
    {
        $this->loginService->store($request->validated());
        
        return redirect()->route('frontend.home');
    }

    /**
     * url: auth/logout
     * method: post
     * name: auth.logout
     * 
     * @return void
     */
    public function logout(): void
    {
        
    }


}