<?php

namespace App\Domains\Auth\Events\Role;

use App\Domains\Auth\Models\Role;
use Illuminate\Queue\SerializesModels;

class RoleCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $role;
    
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}