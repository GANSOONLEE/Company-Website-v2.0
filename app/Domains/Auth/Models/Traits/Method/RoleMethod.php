<?php

namespace App\Domains\Auth\Models\Traits\Method;

trait RoleMethod
{
    public function getCountWithUser()
    {
        // $count = User::
        $count = $this->users()->count();
        $this->setAttribute('count', $count);
        return $this->count;
    }
}