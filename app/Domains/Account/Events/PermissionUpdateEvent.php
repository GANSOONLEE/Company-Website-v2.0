<?php

namespace App\Domains\Account\Events;

use App\Models\Role;
use Illuminate\Http\Request;


class PermissionUpdateEvent{

    public function updatePermission(Request $request){

        try{
            // Define variable
            $roleName = $request->role;
            $permissions = json_decode($request->permissions);
            
            // Find role
            $role = Role::where('name', $roleName)->first();

            // update data
            $debug = $role->updatePermission($permissions);

            $status = [
                'status'=>'success',
            ];

        }catch(\Exception $e){

            $status = [
                'status' => 'error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];

        }

        return response()->json($status);

    }

}