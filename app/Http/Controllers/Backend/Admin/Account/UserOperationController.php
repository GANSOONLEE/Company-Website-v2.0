<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;

class UserOperationController extends Controller{

    public function userOperation(){
        return view('backend.admin.account.user-operation');
    }

}