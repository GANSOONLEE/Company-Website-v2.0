<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\Role;

trait UserRelationship
{

    /**
     * Get the role relationship role instance
     * @return mixed
     */

     public function roles(): mixed
     {
         return $this->belongsToMany(Role::class, 'users_roles', 'user_email', 'role_name', 'email', 'name');
     }

}