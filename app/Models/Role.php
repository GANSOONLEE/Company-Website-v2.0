<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'name';
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
     * Get permissions
     */

    public function getPermissions()
    {
        return DB::table('roles_permissions')
            ->select('permission_name')
            ->where('role_name', $this->name)
            ->get()
            ->pluck('permission_name')
            ->toArray();
    }

    public function hasPermission($permissionName)
    {
        $count = DB::table('roles_permissions')
            ->where('role_name', $this->name)
            ->where('permission_name', $permissionName)
            ->count();

        return $count > 0;
    }

}
