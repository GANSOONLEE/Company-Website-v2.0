<?php

namespace App\Listeners;

use App\Models\Operation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Database\Eloquent\Model;

class OperationCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Operation::creating(function (Model $model) {

        });
    }
}
