<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Request\PasswordRequest;
use App\Domains\Auth\Services\PasswordService;

// Request
use App\Domains\Auth\Request\RenewPasswordRequest;
use App\Domains\Auth\Request\UpdatePasswordRequest;

// Laravel Support
use Illuminate\Http\Request;


class PasswordController
{

    protected $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * url: auth/password/change
     * method: get
     * name: auth.password.change
     * 
     * @return \Illuminate\View\View
     */
    public function change(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    /**
     * url: auth/password/change
     * method: patch
     * name: auth.password.update
     * 
     * @return mixed
     */
    public function update(UpdatePasswordRequest $request): mixed
    {
        $this->passwordService->update($request->validated());
        return redirect()->back()->with('success', 'Your password has been update successfully.');
    }

    /**
     * url: auth/password/account-help
     * method: get
     * name: auth.password.help
     * 
     * @return \Illuminate\View\View;
     */
    public function help(): \Illuminate\View\View
    {
        return view('auth.help-center');
    }

    /**
     * url: auth/password/reset
     * method: get
     * name: auth.password.reset
     * 
     * @return mixed
     */
    public function reset(Request $request): mixed
    {
        $email = $request->email;
        try{
            $this->passwordService->resetPassword($email);
            return redirect()->back()->with('success', 'The reset password email will send to your mailbox!');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * url: auth/password/verify
     * method: get
     * name: auth.password.verify
     * 
     */
    public function verify(Request $request)
    {
        $user = $this->passwordService->verify($request);
        $email = $user->email;

        return view('auth.reset-password', compact('email'));
    }

    /**
     * url: auth/password/password-reset
     * method: get
     * name: auth.password.password-reset
     * 
     * @return mixed
     */
    // public function resetPassword(Request $request): mixed
    // {
    //     return view('auth.reset-password', compact('email'));
    // }

    /**
     * url: auth/password/renew
     * method: patch
     * name: auth.password.renew
     * @param RenewPasswordRequest $request
     * 
     * @return mixed
     */
    public function renew(RenewPasswordRequest $request): mixed
    {
        $this->passwordService->renew($request->validated());
        return view('auth.login')->with('success', 'Your password has been change successfully.');
    }

}