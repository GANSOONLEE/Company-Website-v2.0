<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'contact_phone',
        'whatsapp_phone',
        'email',
        'password',
        'birthday',
        'address',
        'profession',
        'shop_name',
        'provider_id',
        'avatar',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship
     */

    public function getRole(){

        return DB::table('users_roles')
        ->select('user_email', 'role_name')
        ->where('user_email', $this->email)
        ->get()
        ->pluck('role_name');
    }

    public function getRoleEntity(){

        $role = DB::table('users_roles')
        ->select('user_email', 'role_name')
        ->where('user_email', $this->email)
        ->get()
        ->pluck('role_name');

        $roleOfUser = Role::where('name', $role)->first();

        return $roleOfUser;
    }

    public function isAdmin(){

        $roles = $this->getRole();
        $needle = 'admin';
        return strpos($roles, $needle);
    }

    public function isUser(){

        $roles = $this->getRole();
        $needle = 'user';
        return strpos($roles, $needle);

    }

}
