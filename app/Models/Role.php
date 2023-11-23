<?php

namespace App\Models;

// Laravel Support
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


// Model
use App\Models\User;
use Illuminate\Support\Collection;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'weight'
    ];

    /**
     * Relationship
     */
    public function permissions(): Collection
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_name', 'permission_name', 'name', 'name')->get();
    }

    /**
     * Get user relationship with user
     */

    public function users(): Collection
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_name', 'user_email', 'name', 'email')
            ->get();
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

    /**
     * @param array $permissionGroup 
     * @return boolean
     */
    
    public function updatePermission($permissionGroup)
    {
        foreach($permissionGroup as $permission){

            $permissionName = $permission->name;
            $isChecked = $permission->checked;

            $existingRecord = DB::table('roles_permissions')
                ->where('role_name', $this->name)
                ->where('permission_name', $permissionName)
                ->exists();

            if ($isChecked && !$existingRecord) {
                DB::table('roles_permissions')->insert([
                    'role_name' => $this->name,
                    'permission_name' => $permissionName,
                ]);
            } elseif (!$isChecked && $existingRecord) {
                DB::table('roles_permissions')
                    ->where('role_name', $this->name)
                    ->where('permission_name', $permissionName)
                    ->delete();
            }
                
        }

        return true;
    }

}
