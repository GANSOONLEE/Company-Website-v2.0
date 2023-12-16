<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Request\PasswordRequest;
use App\Domains\Auth\Services\PasswordService;

use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;

class PasswordController
{

    protected $passwordService;

    public function __construct(PasswordRequest $passwordService)
    {
        $this->$passwordService = $passwordService;
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