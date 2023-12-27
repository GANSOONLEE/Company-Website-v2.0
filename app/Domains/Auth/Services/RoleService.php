<?php

namespace App\Domains\Auth\Services;

use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Domains\Auth\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Domains\Auth\Events\Role\RoleCreated;
use App\Domains\Auth\Events\Role\RoleUpdated;
use App\Domains\Auth\Events\Role\RoleDeleted;
use App\Domains\Auth\Events\Role\RoleRestored;
use App\Domains\Auth\Events\Role\RoleDestroyed;

class RoleService extends BaseService
{
    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @param string $state
     * @param bool|int $perPage
     *
     * @return mixed
     */
    public function getByWeight($order, $perPage = false)
    {
        if(is_numeric($perPage)){
            return $this->model::byState($order)->paginate($order);
        }

        return $this->model::byState($order)->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerRole(array $data = []): Role
    {
        DB::beginTransaction();

        try{
            $role = $this->createRole($data);
        }catch (Exception $e){
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your role.'));
        }

        DB::commit();
        return $role;
    }

    /**
     * @param array $data
     *
     * @return Role
     * @throws GeneralException
     * @throws \Throwable
     */ 
    public function store(array $data = []): Role
    {
        DB::beginTransaction();

        try{
            $role = $this->createRole([
                'name' => $data['name'],
                'weight' => $data['weight']
            ]);

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your role. Please try again.'));
        }

        event(new RoleCreated($role));

        DB::commit();
        return $role;
    }

    
    /**
     * @param string $id
     * 
     * @return mixed
     */
    public function getRole(string $id): mixed
    {
        $role = Role::where('id', $id)->first();
        return response()->json($role);
    }
    
    /**
     * @param array $data
     * @return Role
     */
    public function update(array $data = []): Role
    {
        DB::beginTransaction();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try{
            $role = Role::where('id', $data['id'])->first();

            DB::table('users_roles')
                ->where('role_name', $role->name)
                ->update([
                    'role_name' => $data['name']
            ]);

            $role->update([
                'name' => $data['name'],
                'weight' => $data['weight'],
            ]);

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            throw new GeneralException('There was an problem updating your role.');
        }

        DB::commit();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        event(new RoleUpdated($role));
        return $role;
    }

    /**
     * @param Role $role
     *
     * @return Role
     * @throws GeneralException
     */ 
    public function delete(Role $role): Role
    {
        if($role->id === auth()->id()){
            throw new GeneralException(__('You cannot delete your role.'));
        }

        if($this->deleteById($role->id)){
            event(new RoleDeleted($role));
            return $role;
        }

        throw new GeneralException('There was a problem deleting this role. Please try again.');
    }

    /**
     * @param Role $role
     *
     * @return Role
     * @throws GeneralException
     */
    public function restore(Role $role): Role
    {
        if($role->restore()){
            event(new RoleRestored($role));

            return $role;
        }

        throw new GeneralException('There was a problem restoring this role. Please try again.');
    }

    public function destroy(Role $role): bool
    {
        if($role->forceDelete()){
            event(new RoleDestroyed($role));

            return true;
        }

        throw new GeneralException('There was a problem deleting this role. Please try again.');
    }

    public function createRole(array $data = []): Role
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'weight' => $data['weight'] ?? null
        ]);
    }
}