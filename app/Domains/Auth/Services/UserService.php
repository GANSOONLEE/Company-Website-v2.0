<?php

namespace App\Domains\Auth\Services;

use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Domains\Auth\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Domains\Auth\Events\User\UserCreated;
use App\Domains\Auth\Events\User\UserUpdated;
use App\Domains\Auth\Events\User\UserDeleted;
use App\Domains\Auth\Events\User\UserRestored;
use App\Domains\Auth\Events\User\UserDestroyed;

class UserService extends BaseService
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param $state
     * @param bool|int $perPage
     *
     * @document https://learnku.com/docs/laravel/9.x/pagination/12247#ed54e0
     * 
     * @return mixed
     */
    public function getByPage($perPage = false)
    {
        if(is_numeric($perPage)){
            return $this->model::byPage()->paginate($perPage);
        }

        return $this->model::byPage()->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function registerUser(array $data = []): User
    {
        DB::beginTransaction();

        try{
            $user = $this->createUser($data);
        }catch (Exception $e){
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your account.'));
        }

        DB::commit();
        return $user;
    }

    /**
     * @param array $data
     *
     * @return User
     * @throws GeneralException
     * @throws \Throwable
     */ 
    public function store(array $data = []): User
    {
        DB::beginTransaction();
       
        try{
            $user = $this->createUser([
                'name' => $data['name'],
                'contact_phone' => $data['contact_phone'] ?? null,
                'whatsapp_phone' => $data['whatsapp_phone'] ?? null,
                'email' => $data['email'],
                'password' => $data['password'] ?? 'frozen',
                'birthday' => $data['birthday'] ?? null,
                'address' => $data['address'] ?? null,
                'profession' => $data['profession'] ?? null,
                'shop_name' => $data['shop_name'] ?? null,
            ]);

            $user->roles()->attach($data['role'] ?? null);

        }catch(Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your account. Please try again.'));
        }


        event(new UserCreated($user));

        DB::commit();
        return $user;
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */ 
    public function delete(User $user): User
    {
        if($user->id === auth()->id()){
            throw new GeneralException(__('You cannot delete yourself.'));
        }

        if($this->deleteById($user->id)){
            event(new UserDeleted($user));
            return $user;
        }

        throw new GeneralException('There was a problem deleting this user. Please try again.');
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws GeneralException
     */
    public function restore(User $user): User
    {
        if($user->restore()){
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException('There was a problem restoring this user. Please try again.');
    }

    public function destroy(User $user): bool
    {
        if($user->forceDelete()){
            event(new UserDestroyed($user));

            return true;
        }

        throw new GeneralException('There was a problem deleting this user. Please try again.');
    }

    public function createUser(array $data = []): User
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'contact_phone' => $data['contact_phone'] ?? null,
            'whatsapp_phone' => $data['whatsapp_phone'] ?? null,
            'email' => $data['email'] ?? null,
            'password' => ($data['password']) ?? null,
            'birthday' => $data['birthday'] ?? null,
            'address' => $data['address'] ?? null,
            'profession' => $data['profession'] ?? null,
            'shop_name' => $data['shop_name'] ?? null,
        ]);
    }
}