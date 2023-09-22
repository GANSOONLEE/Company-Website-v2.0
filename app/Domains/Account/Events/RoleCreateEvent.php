<?php

namespace App\Domains\Account\Events;

use App\Models\Role;
use Barryvdh\TranslationManager\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Barryvdh\TranslationManager\Manager;

class RoleCreateEvent{

    public function createRole(Request $request){

        // Define variable
        $roleID = $request->input('role-id');
        $roleWeight = $request->input('role-weight');
        $roleNameZH = $request->input('role-name-zh');
        $roleNameEN = $request->input('role-name-en');

        /**
         * Create Role
         */

        $roleData = [
            'name' => $roleID,
            'weight' => $roleWeight,
        ];

        Role::create($roleData);

        /**
         * Add translation
         */

        $manager = app(Manager::class);
        $controller = new Controller($manager);

        // Request
        $requestAdd = Request::create('translations/add/account', 'POST' , 
            [
                'keys' => [
                    "roles.$roleID"
                ]
            ]
        );

        $controller->postAdd('account', $requestAdd);

        $requestEditZH = Request::create('translation/edit/account', 'POST',
            [
                'name' => 'zh|' . "roles.$roleID",
                'group' => 'account',
                'value' => $roleNameZH,
            ]
        );
        $requestEditEN = Request::create('translation/edit/account', 'POST',
            [
                'name' => 'en|' . "roles.$roleID",
                'group' => 'account',
                'value' => $roleNameEN,
            ]
        );

        $controller->postEdit('account', $requestEditZH);
        $controller->postEdit('account', $requestEditEN);

        $controller->postPublish('account');

        return redirect()->back();
    }

}