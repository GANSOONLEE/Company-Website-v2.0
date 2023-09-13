<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthenticate
{
    public function handle($request, Closure $next)
    {

        $user = Auth::user();

        // if the user does not exist or the remember_token does not match, redirect to the login page
        if (!$user || $request->input('remember_token') !== $user->remember_token) {
            return redirect()->route('login');
        }

        $roles = $user->getRole();
        
        // if the user's role is not 'user' or 'admin', the user will also be redirected to the login page.
        $needle = 'user';
       
        if (strpos($roles, $needle) == false) {
            return redirect()->route('auth.login');
        }

        // the user exists and the role meets the conditions, continue the request
        return $next($request);
    }
}
