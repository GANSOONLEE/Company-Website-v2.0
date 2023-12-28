<?php

namespace App\Domains\Auth\Events\Role;

use App\Domains\Auth\Models\Role;
use Illuminate\Queue\SerializesModels;
use App\Events\BaseEvent;

class RoleRestored extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $role;
    
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->createOperation('restore', 'role', $role->name);
    }
}