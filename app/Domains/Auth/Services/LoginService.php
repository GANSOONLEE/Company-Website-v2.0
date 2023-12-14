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
     * @return User
     * @throws GeneralException
     * @throws \Throwable
     */ 
    public function store(array $data = []): User
    {
        DB::beginTransaction();

        try{

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->has('remember'))) {
                $user = Auth::user();
                $rememberToken = Str::random(60);
    
                $user->update(['remember_token' => $rememberToken]);
    
                $cookie = Cookie::make('remember_token', $rememberToken, 43200);
    
                return redirect()->route('frontend.home')->withCookie($cookie);
            }

        }catch(Exception $e){
            DB::rollBack();
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

}