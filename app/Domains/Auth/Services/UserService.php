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

use App\Domains\Cart\Models\Cart;
use App\Domains\Order\Models\Order;

class UserService extends BaseService
{

    public $model;

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
            return $this->model::with('roles')->byPage()->paginate($perPage);
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
     * @param string $email
     * 
     * @return mixed
     */
    public function getUser(string $email): mixed
    {
        $user = User::where('email', $email)->with('roles')->first();
        return response()->json($user);
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
     * @param array $data
     * 
     * @return User
     * @throws GeneralException
     */

    public function update(array $data = []){

        DB::beginTransaction();

        $user = User::where('id', $data['id'])->first();
        $emailCurrent = $user->email;

        try{

            $user->roles()->first()->name !== $data['role'] ?
                $user->updateRole($data['role']) :
                null;

            DB::statement('SET FOREIGN_KEY_CHECKS=0');

                if ($emailCurrent !== $data['email']) {
                    $pivot = $user->roles()->first()->pivot;
                    $pivot ?
                        $pivot->update(['user_email' => $data['email']]) :
                        null;

                }

                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]);
                
            DB::statement('SET FOREIGN_KEY_CHECKS=1');


        }catch(Exception $e){
            dd(
                $e->getMessage(),
                $e->getLine(),
                $e->getFile(),
            );

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating your account. Please try again.'));
        }

        event(new UserUpdated($user));

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
        DB::beginTransaction();

        try{

            // Delete Order
            $orders = Order::where('user_email', $user->email)->get();
            foreach ($orders as $order)
            {
                DB::table('orders_detail')->where('order_id', $order->code)->delete(); 
                $order->delete();
            }

            // Delete Cart
            Cart::where('user_email', $user->email)->delete();

            // Delete User Role
            DB::table('users_roles')->where('user_email', $user->email)->delete();

            if($user->forceDelete()){
                event(new UserDestroyed($user));
            }

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return false;
        }

        DB::commit();
        return true;
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

    /**
     * Search User
     */
    public function search(string $searchTerm)
    {
        return User::with('roles')
            ->leftJoin('users_roles', 'users.email', '=', 'users_roles.user_email')
            ->leftJoin('roles', 'users_roles.role_name', '=', 'roles.name')
            ->select('users.*', 'roles.name as roles_name')
            ->where(function ($query) use ($searchTerm) {
                $query->where('users.name', 'like', "%$searchTerm%")
                    ->orWhere('users.email', 'like', "%$searchTerm%")
                    ->orWhere('users.shop_name', 'like', "%$searchTerm%")
                    ->orWhere('users.profession', 'like', "%$searchTerm%")
                    ->orWhere('users.contact_phone', 'like', "%$searchTerm%")
                    ->orWhere('users.whatsapp_phone', 'like', "%$searchTerm%")
                    ->orWhere('roles.name', 'like', "%$searchTerm%");
            })
            ->groupBy('users.email')
            ->orderBy('roles.weight', 'asc')
            ->withTrashed()
            ->paginate(5)
            ->withQueryString();
    }
}