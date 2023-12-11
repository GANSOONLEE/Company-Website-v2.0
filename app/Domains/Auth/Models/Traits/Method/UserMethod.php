<?php

namespace App\Domains\Auth\Models\Traits\Method;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Role;

use Illuminate\Support\Facades\DB;

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
     * Assign the role to user
     * @param string|null $role 
     * 
     * @return void
     */
    public function assignRole(string|null $role = 'new_user')
    {
        $this->roles()->attach($role);
    }

    /**
     * update the role to user
     * @param string $roleName User current role
     * 
     * @return bool
     */
    public function updateRole(string $roleName): bool
    {
        DB::beginTransaction();
        
        try{

            $pivot = $this->roles()->first()->pivot;
        
            $pivot ?
                $pivot->update(['role_name' => $roleName]) :
                null;

        
        }catch(\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            return false;
        }

        DB::commit();

        return true;
    }

    /**
     * Remove the role from user
     * @param User $user
     * 
     * @return void
     */
    public function removeRole(User $user)
    {
        $this->roles()->detach($user);
    }

}