<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Permission;

trait RoleRelationship
{

    /**
     * Get the users relationship role instance
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_name', 'user_email', 'name', 'email');
    }

    /**
     * Get the permissions relationship role instance
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_name', 'permission_name', 'role_name', 'name', 'name');
    }

}