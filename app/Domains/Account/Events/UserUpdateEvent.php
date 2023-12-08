<?php

namespace App\Domains\Account\Events;

use App\Domains\Auth\Models\User;
use Illuminate\Http\Request;

class UserUpdateEvent{

    public function updateUser(Request $request){

        // Define variable
        $email = $request->email;
        $role = $request->role;

        // Update User Role
        $user = User::where('email', $email)->first();
        $user->updateRole($role);

        return redirect()->back();

    }

}