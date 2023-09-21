<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'weights'
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
        // Get all roles.
        $roles = Role::all();
    
        // Get the permissions belonging to the current role.
        $selfPermissions = DB::table('roles_permissions')
            ->select('permission_name')
            ->where('role_name', $this->name)
            ->get()
            ->pluck('permission_name')
            ->toArray();
    
        // Get the permissions of roles with lower weight than the current role.
        $weight = (int)$this->weight;
        $rolesWithLowerWeight = $roles->filter(function ($role) use ($weight) {
            return (int)$role->weight < $weight;
        });
    
        $permissionsWithInheritance = [];
    
        // Check if the current role has each permission.
        foreach ($rolesWithLowerWeight as $role) {
            $permissions = DB::table('roles_permissions')
                ->select('permission_name')
                ->where('role_name', $role->name)
                ->get()
                ->pluck('permission_name')
                ->toArray();
    
            foreach ($permissions as $permission) {
                // Check if the current role has this permission.
                $hasPermission = in_array($permission, $selfPermissions);
    
                $permissionsWithInheritance[] = [
                    'name' => $permission,
                    'inherited' => false,
                    'hasPermission' => true,
                ];
            }
        }
    
        // Add the permissions belonging to the current role.
        foreach ($selfPermissions as $permission) {
            $permissionsWithInheritance[] = [
                'name' => $permission,
                'inherited' => true,
                'hasPermission' => true, // Since it's the current role's permission.
            ];
        }
    
        return $permissionsWithInheritance;
    }
      

    public function hasPermission($permissionName)
    {

        $count = DB::table('roles_permissions')
            ->where('role_name', $this->name)
            ->where('permission_name', $permissionName)
            ->count();

        if ($count > 0) {
            return true;
        }

        $weight = (int)$this->weight;
        $rolesWithLowerWeight = Role::where('weight', '<', $weight)->get()->pluck('name');

        foreach ($rolesWithLowerWeight as $roleName) {
            $count = DB::table('roles_permissions')
                ->where('role_name', $roleName)
                ->where('permission_name', $permissionName)
                ->count();

            if ($count > 0) {
                return true;
            }
        }

        return false;
    }

}
