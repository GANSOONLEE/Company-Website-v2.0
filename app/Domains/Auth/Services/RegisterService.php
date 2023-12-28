<?php

namespace App\Domains\Auth\Services;

// Model
use App\Domains\Auth\Models\User;

// Base Service
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
// Laravel Support
use Illuminate\Support\Facades\DB;

class RegisterService extends BaseService
{
    
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data = []): User
    {
        DB::beginTransaction();

        try{
            $user = $this->createUser([
                'name' => $data['name'] ?? null,
                'email' => $data['email'] ?? null,
                'contact_phone' => $data['contact_phone'],
                'whatsapp_phone' => $data['whatsapp_phone'] ?? $data['contact_phone'],
                'samePhone' => $data['samePhone'] ?? null,
                'shop_name' => $data['shop_name'] ?? null,
                'birthday' => $data['birthday'] ?? null,
                'job' => $data['job'] ?? null,
                'address' => $data['address'] ?? null,
                'password' => $data['password'] ?? null,
            ]);
        }catch(\Exception $e){
            DB::rollBack();
            throw new GeneralException('There was a problem creating your account. Please try again');
        }

        DB::commit();
        $user->assignRole();

        Auth::login($user);

        return $user;
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data = []): User
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
                'email' => $data['email'] ?? null,
                'contact_phone' => $data['contact_phone'],
                'whatsapp_phone' => $data['whatsapp_phone'] ?? null,
                'shop_name' => $data['shop_name'] ?? null,
                'birthday' => $data['birthday'] ?? null,
                'job' => $data['job'] ?? null,
                'address' => $data['address'] ?? null,
                'password' => $data['password'] ?? null,
        ]);
    }
}