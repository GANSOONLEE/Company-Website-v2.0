<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

// Model
use App\Domains\Auth\Models\Role;
use App\Domains\Cart\Models\Cart;
use App\Domains\Order\Models\Order;

// Laravel Support
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationship
{

    /**
     * Get the role relationship role instance
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_email', 'role_name', 'email', 'name');
    }

    /**
     * Get the cart relationship cart instance
     * @return HasMany
     */
    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_email', 'email');
    }

    /**
     * Get the order relationship order instance
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class, 'user_email', 'email');
    }

}