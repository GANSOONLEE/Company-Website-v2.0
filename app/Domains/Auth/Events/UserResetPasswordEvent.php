<?php

namespace App\Domains\Auth\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Domains\Auth\Models\User;

class UserResetPasswordEvent {

    public function userResetPassword(Request $request){

        $email = $request->email;
        $token = $request->token;

        // Check information
        if (User::where(['email' => $email, 'created_at' => date('Y:m:d h:m:s', $token)])) {

            $user = User::where('email', $email)->first();

            $rememberToken = Str::random(60);
    
            $user->update([
                'remember_token' => $rememberToken,
                'password' => null,
            ]);
    
            $cookie = Cookie::make('remember_token', $rememberToken, 43200);
    
            Auth::login($user);
    
            return redirect()->route('auth.reset.password-form');

        }else{
            abort(319, 'Invalid Token');
        }

    }

}