<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Domains\Auth\Models\User;

trait RoleRelationship
{

    /**
     * Get the role relationship role instance
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_name', 'user_email', 'name', 'email');
    }

}