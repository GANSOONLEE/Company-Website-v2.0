<?php

namespace App\Http\Controllers\Backend\Admin\Account;

use App\Http\Controllers\Controller;
use App\Domains\Data\Models\Operation;

class UserOperationController extends Controller{

    public function userOperation(){

        $operations = Operation::orderBy("created_at","desc")->get();

        return view('backend.admin.account.user-operation', compact('operations'));
    }

}