<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;

class AccountBannedController extends Controller{

    public function accountBanned(){

        // get data
        $query = \App\Models\User::query();
        $users = $query->whereIn('status', ["Unavailable", "Available", "Banned"])->get();

        $unavailable = $users->where('status', "Unavailable");
        $available = $users->where('status', "Available");
        $banned = $users->where('status', "Banned");

        return view('backend.admin.account.account-banned', compact('unavailable', 'available', 'banned'));
    }

}

