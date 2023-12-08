<?php

namespace App\Domains\Auth\Events\User;

use App\Domains\Auth\Models\User;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}