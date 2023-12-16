<?php

namespace App\Domains\Auth\Events;

use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class VerifyEmailEvent{

    public function verifyEmail(Request $request){

        // Define variable
        $email = $request->email;
        $token = $request->token;

        // Check information
        if (User::where(['email' => $email, 'created_at' => date('Y:m:d h:m:s', $token)])) {

            $user = User::where('email', $email)->first();

            $user->update([
                'status' => 'Available'
            ]);

            $rememberToken = Str::random(60);
    
            $user->update(['remember_token' => $rememberToken]);
    
            $cookie = Cookie::make('remember_token', $rememberToken, 43200);
    
            Auth::login($user);
    
            if($user->isAdmin() || $user->getRole() == "root"){
                return redirect()->route('backend.admin.dashboard')->withCookie($cookie);
            }else{
                if($user->getRoleEntity()->hasPermission('user_backend')){
                    return redirect()->route('backend.user.cart')->withCookie($cookie);
                }
                return redirect()->route('frontend.home')->withCookie($cookie);
            }

        }

    }

}