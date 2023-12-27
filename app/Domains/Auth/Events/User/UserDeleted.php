<?php

namespace App\Domains\Auth\Events\User;

use App\Domains\Auth\Models\User;
use Illuminate\Queue\SerializesModels;
use App\Events\BaseEvent;

class UserDeleted extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->createOperation('delete', 'user', $user->name);
    }
}