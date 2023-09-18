<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;

class AccountBannedController extends Controller{

    public function accountBanned(){
        return view('backend.admin.account.account-banned');
    }

}