<?php

namespace App\Domains\Auth\Events;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Mail\RegisterVerify;
use Illuminate\Support\Facades\Mail;

class RegisterEvent{

    public function register(Request $request){

        // Define variable
        $name = $request->name;
        $status = "Available";
        $contact_phone = $request->contact_phone;
        $whatsapp_phone = $request->whatsapp_phone;
        $email = $request->email;
        $password = $request->password;
        $birthday = $request->birthday;
        $address = $request->address;
        $profession = $request->profession;
        $shop_name = $request->shop_name;

        if(config('function.email_verify')){
            $status = "Unavailable";
        };

        // Check Duplication Email
        $valid = User::where('email', $email)->first();

        if($valid){
            return false;
        }

        if($whatsapp_phone == "" || $whatsapp_phone == null){
            $whatsapp_phone = $contact_phone;
        }

        // Create new user
        $userData = [
            'name' => $name,
            'status' => $status,
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

        if(config('function.email_verify')){

            Mail::to($email)->send(new RegisterVerify($user));

        };

        // Generate token
        $rememberToken = Str::random(60);
        $user->update(['remember_token' => $rememberToken]);

        // Preset Role
        $user->assignRole('new_user');

        // Save token at cookie
        $cookie = Cookie::make('remember_token', $rememberToken, 43200);

        // Need Email Verify?
        
        // Login it
        Auth::login($user);
        return redirect()->route('backend.user.dashboard')->withCookie($cookie);

    }
    
}
