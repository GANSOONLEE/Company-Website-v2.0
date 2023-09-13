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
    
            return redirect()->route('backend.admin.dashboard')->withCookie($cookie);
        } else {
            // 验证失败，返回错误信息或重定向回登录页面
            return back()->withErrors(['email' => '登录失败，请检查您的邮箱和密码。']);
        }

    }

}