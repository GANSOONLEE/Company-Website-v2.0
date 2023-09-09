<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    /**
     * Relationship
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_name', 'permission_name');
    }

    /**
     * Function
     */
    public function hasPermissions($permissionName)
    {
        return $this->permissions->contains('role_name', $permissionName);
    }

    public function getPermissions()
    {
        return $this->permissions->pluck('name')->toArray();
    }

}
