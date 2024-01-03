<?php

namespace App\Domains\Auth\Services;

// Base Service
use App\Exceptions\GeneralException;
use App\Services\BaseService;

// Model
use App\Domains\Auth\Models\User;

// Email
use App\Mail\ResetPassword;

// Laravel Support
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PasswordService extends BaseService
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Send a reset password email to the user
     * @param string $email
     */
    public function resetPassword(string $email)
    {
        // check email exists
        $user = $this->model->where('email', $email)->first();

        if(!$user || !$user instanceof User) {
            throw new GeneralException('This email haven\'t found');
        }

        Mail::to($email)->send(new ResetPassword($user));
    }

    /**
     * Verify Link
     * 
     * @return User 
     */
    public function verify(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $user = '';

        // Check information
        if ($this->model->where(['email' => $email, 'created_at' => date('Y:m:d h:m:s', $token)])) {
            
            $user = $this->model->where('email', $email)->first();

            $rememberToken = Str::random(60);
    
            $user->update([
                'remember_token' => $rememberToken,
                'password' => null,
            ]);

        }else{
            abort(319, 'Invalid Token');
        }

        return $user;
    }

    /**
     * @param array $data
     */
    public function renew(array $data = [])
    {
        $user =  $this->model->where('email', $data['email'])->first();
        $user->update([
            'password' => $data['password'],
        ]);
    }

    /**
     * Change password
     * @param array $data
     */
    public function update(array $data = [])
    {
        $user = $this->model->where('email', $data['email'])->first();

        if(!Auth::attempt(["email" => $data['email'], "password" => $data['current-password']])){
            throw new GeneralException('The old password are wrong!');
        }

        // dd($data);

        $user->update([
            'password' => $data['new-password'],
        ]);
    }
}