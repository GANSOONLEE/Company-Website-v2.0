<?php

namespace App\Domains\Auth\Events;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class RegisterEvent{

    public function register(Request $request){

        // Define variable
        $name = $request->name;
        $contact_phone = $request->contact_phone;
        $whatsapp_phone = $request->whatsapp_phone;
        $email = $request->email;
        $password = $request->password;
        $birthday = $request->birthday;
        $address = $request->address;
        $profession = $request->profession;
        $shop_name = $request->shop_name;

        // Check Duplication Email
        $valid = User::where('email', $email)->first();

        if($valid){
            return false;
        }

        // Create new user
        $userData = [
            'name' => $name,
            'contact_phone' => $contact_phone,
            'whatsapp_phone' => $whatsapp_phone,
            'email' => $email,
            'password' => bcrypt($password),
            'birthday' => $birthday,
            'address' => $address,
            'profession' => $profession,
            'shop_name' => $shop_name,
        ];

        $user = User::create($userData);

        // Generate token
        $rememberToken = Str::random(60);
        $user->update(['remember_token' => $rememberToken]);

        // Save token at cookie
        $cookie = Cookie::make('remember_token', $rememberToken, 43200);

        // Login it
        Auth::login($user);
        return redirect()->route('backend.user.dashboard')->withCookie($cookie);

    }

}