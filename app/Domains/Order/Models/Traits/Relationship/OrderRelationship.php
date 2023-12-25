<?php

namespace App\Domains\Order\Models\Traits\Relationship;

use Illuminate\Support\Facades\DB;

// Model
use App\Domains\Auth\Models\User;

trait OrderRelationship
{

    public function detail()
    {
        return DB::table('orders_detail')
            ->where("order_id", $this->code);
    }

    public function user()
    {
        return User::where('email', $this->email);
    }

}