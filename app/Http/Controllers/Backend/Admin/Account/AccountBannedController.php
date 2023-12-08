<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;

class AccountBannedController extends Controller{

    public function accountBanned(){

        // get data
        $users = \App\Domains\Auth\Models\User::join("users_roles","users.email","=","users_roles.user_email")
            ->join("roles","users_roles.role_name","=","roles.name")
            ->select(
                "users.name",
                "users.status",
                "users.email",
                "users.shop_name",
                "role_name",
                "roles.weight"
            )
            ->where('roles.weight', '<', auth()->user()->getRoleEntity()->weight)
            ->get();

        return view('backend.admin.account.account-banned', compact('users'));
    }

}

