<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle($request, Closure $next)
    {

        $user = Auth::user();

        if(!$user->getRoleEntity()->hasPermission('admin')){
            abort(403, 'Insufficient permissions');
        }

        // the user exists and the role meets the conditions, continue the request
        return $next($request);
    }
}
