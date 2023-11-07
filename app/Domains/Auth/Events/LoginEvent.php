<?php

namespace App\Domains\Auth\Events;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class LoginEvent{

    public function login(Request $request){

        // Define variable
        $email = $request->email;
        $password = $request->password;

        // Check information
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $rememberToken = Str::random(60);
            
            $user = Auth::user();
    
            $user->update(['remember_token' => $rememberToken]);
    
            $cookie = Cookie::make('remember_token', $rememberToken, 43200);
    
            Auth::login($user);
    
            if($user->isAdmin() || $user->getRole()[0] == "root"){
                return redirect()->route('backend.admin.dashboard')->withCookie($cookie);
            }else{
                return redirect()->route('backend.user.cart')->withCookie($cookie);
            }

        } else {
            return back()->withErrors(['email' => 'Login Failure, please check your email address and password.']);
        }

    }

}