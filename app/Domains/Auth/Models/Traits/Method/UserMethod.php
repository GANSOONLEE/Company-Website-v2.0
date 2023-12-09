<?php

namespace App\Domains\Auth\Models\Traits\Method;

use App\Domains\Auth\Models\Role;

trait UserMethod
{
    /**
     * Check are input role weight higher than current user's role weight
     * @param Role $role
     * 
     * @return bool
     */
    public function hasHigherPermissionWeight(Role $role): bool
    {
        return $this->roles()->first()->weight > $role->weight;
    }

    /**
     * Assign the role to current user
     * @param string $role 
     * 
     * @return void
     */
    public function assignRole($role = 'new_user')
    {
        $this->roles()->attach($role);
    }

}