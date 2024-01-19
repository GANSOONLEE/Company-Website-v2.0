<?php

namespace App\Domains\Auth\Services;

use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Domains\Auth\Models\User;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginService extends BaseService
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     * @throws \Throwable
     */ 
    public function store(array $data = []): mixed
    {
        DB::beginTransaction();

        try{

            $credentials = [
                'email' => $data['email'], 
                'password' => $data['password']
            ];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
            }else{
                return redirect()->back()
                    ->withErrors([
                        'login_failed' => 'Invalid email or password.'
                    ])
                    ->withInput([
                        'email' => $data['email']
                    ]);
            }

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            throw new GeneralException(__('There was a problem login your account\. Please try again.'));
        }

        DB::commit();
        return $user;
    }

    /**
     * @param User $user
     *
     * @return void
     * @throws GeneralException
     */
    public function logout(User $user): void
    {
        try{
            Auth::user();
        }catch (Exception $e){
            Log::error("Error ! ". $e->getMessage());
            Log::error("At". $e->getFile() . ", Line: " . $e->getLine());
            throw new GeneralException('There was a problem logout your account\. Please try again.');
        }
    }

    /**
     * @param User $user
     * @param array $data
     *
     * @return void
     * @throws GeneralException
     */
    public function destroy(User $user, array $data = [])
    {

        DB::beginTransaction();

        try{

            $credentials = [
                'email' => $user->email, 
                'password' => $data['password']
            ];


            if (Auth::attempt($credentials)) {

                DB::statement('SET FOREIGN_KEY_CHECKS = 0');

                // Delete user relation order
                foreach($user->order()->get() as $order) {
                    $order->detail()->delete();
                    $order->delete();
                }

                // Delete user relation cart
                $user->cart()->get();

                // Delete user relation role
                $user->roles()->get();

                // Delete User
                $user->forceDelete();

                // Logout User
                Auth::logout();

                DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            }else{
                return;
            }

        }catch (Exception $e){
            DB::rollBack();
            throw new GeneralException($e->getMessage());
        }

        DB::commit();
    }

}