<?php

namespace App\Domains\Auth\Events\Role;

use Illuminate\Queue\SerializesModels;
use App\Domains\Auth\Models\Role;
use App\Events\BaseEvent;

class RoleCreated extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $role;
    
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->createOperation('create', 'role', $role->name);
    }
}