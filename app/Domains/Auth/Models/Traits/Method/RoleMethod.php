<?php

namespace App\Domains\Auth\Models\Traits\Method;

use App\Domains\Auth\Models\Role;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait RoleMethod
{
    public function getCountWithUser()
    {
        // $count = User::
        $count = $this->users()->count();
        $this->setAttribute('count', $count);
        return $this->count;
    }

    /**
     * Get all the permissions where it role weight below this role
     */
    public function getAllPermissions()
    {
        $rolesBelowCurrentRole = Role::where('weight', '<' ,$this->weight)->get();

        $belowPermission =  DB::table('roles_permissions')
                ->whereIn('role_name', $rolesBelowCurrentRole->pluck('name')->toArray())
                ->orderBy('permission_name')
                ->groupBy('permission_name');

        $belowPermissionArray = $belowPermission->pluck('permission_name')->toArray();
        $currentPermissionArray = $this->permissions()->pluck('name')->toArray();

        $permissions = [];
        foreach ($belowPermissionArray as $permission)
        {
            $permissions[] = (object)[
                'name' => $permission,
                'inherited' => true
            ];
        }

        foreach ($currentPermissionArray as $permission)
        {
            $permissions[] = (object)[
                'name' => $permission,
                'inherited' => false
            ];
        }

       return $permissions;
    }
}