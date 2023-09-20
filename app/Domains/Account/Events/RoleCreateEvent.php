<?php

namespace App\Domains\Account\Events;

use Illuminate\Http\Request;

class RoleCreateEvent{

    public function createRole(Request $request){

        // Define variable
        $roleID = $request->input('role-id');
        $roleWeight = $request->input('role-weight');
        $roleNameZH = $request->input('role-name-zh');
        $roleNameEN = $request->input('role-name-en');

        dd($roleID, $roleWeight, $roleNameZH, $roleNameEN);

    }

}