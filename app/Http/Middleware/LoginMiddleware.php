<?php

namespace App\Http\Middleware;

use App\Domains\Auth\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        $token =  Cookie::get('remember_token');

        if (!$token) {
            return $next($request);
        }

        $user = User::where('remember_token', $token)
            ->first();


        if (!$user) {
            return $next($request);
        }

        if(config('function.email_verify')){
            $status = $user->status;
            if($status == "Available"){
                Auth::login($user);
            }else{
                $next($request);
            }
        }

        return $next($request);
    }
}
