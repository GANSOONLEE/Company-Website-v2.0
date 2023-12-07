<?php

namespace App\Domains\Auth\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginEvent
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            $rememberToken = Str::random(60);

            $user->update(['remember_token' => $rememberToken]);

            $cookie = Cookie::make('remember_token', $rememberToken, 43200);

            return redirect()->route('frontend.home')->withCookie($cookie);
        }

        throw ValidationException::withMessages([
            'email' => [trans('account.password-or-email-wrong')],
        ]);
    }
}
