<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Request\RegisterRequest;
use App\Domains\Auth\Services\RegisterService;

use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;

class RegisterController
{

    protected $registerService;

    public function __construct(RegisterRequest $registerService)
    {
        $this->$registerService = $registerService;
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
        return view('auth.register');
    }

    /**
     * url: auth/login
     * method: post
     * name: auth.login.store
     * 
     * @return \Illuminate\View\View;
     */
    public function store(): \Illuminate\View\View
    {
        return view('backend.admin.auth.role-management-center');
    }


}