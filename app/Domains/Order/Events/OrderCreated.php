<?php

namespace App\Domains\Order\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Domains\Order\Models\Order;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count;

    /**
     * @param array $data 
     */
    public function __construct()
    {
        $this->count = Order::where('status', 'Pending')->count();
    }

    public function broadcastOn()
    {
        return ['backend'];
    }

   /**
    * Get the name of the broadcast event.
    *
    * @return string
    */
    public function broadcastAs()
    {
        return 'order.created';
    }
}