<?php

namespace App\Domains\Auth\Services;

use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Domains\Auth\Models\Permission;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Domains\Auth\Events\Permission\PermissionCreated;
use App\Domains\Auth\Events\Permission\PermissionUpdated;
use App\Domains\Auth\Events\Permission\PermissionDeleted;
use App\Domains\Auth\Events\Permission\PermissionRestored;
use App\Domains\Auth\Events\Permission\PermissionDestroyed;

class PermissionService extends BaseService
{
    /**
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
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
    public function registerPermission(array $data = []): Permission
    {
        DB::beginTransaction();

        try{
            $permission = $this->createPermission($data);
        }catch (Exception $e){
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your permission.'));
        }

        DB::commit();
        return $permission;
    }

    /**
     * @param array $data
     *
     * @return Permission
     * @throws GeneralException
     * @throws \Throwable
     */ 
    public function store(array $data = []): Permission
    {
        DB::beginTransaction();

        try{
            $permission = $this->createPermission([
                'name' => $data['name'],
                'weight' => $data['weight']
            ]);

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your permission. Please try again.'));
        }

        event(new PermissionCreated($permission));

        DB::commit();
        return $permission;
    }

    /**
     * @param Permission $permission
     *
     * @return Permission
     * @throws GeneralException
     */ 
    public function delete(Permission $permission): Permission
    {
        if($permission->id === auth()->id()){
            throw new GeneralException(__('You cannot delete your permission.'));
        }

        if($this->deleteById($permission->id)){
            event(new PermissionDeleted($permission));
            return $permission;
        }

        throw new GeneralException('There was a problem deleting this permission. Please try again.');
    }

    /**
     * @param Permission $permission
     *
     * @return Permission
     * @throws GeneralException
     */
    public function restore(Permission $permission): Permission
    {
        if($permission->restore()){
            event(new PermissionRestored($permission));

            return $permission;
        }

        throw new GeneralException('There was a problem restoring this permission. Please try again.');
    }

    public function destroy(Permission $permission): bool
    {
        if($permission->forceDelete()){
            event(new PermissionDestroyed($permission));

            return true;
        }

        throw new GeneralException('There was a problem deleting this permission. Please try again.');
    }

    public function createPermission(array $data = []): Permission
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'weight' => $data['weight'] ?? null
        ]);
    }
}