<?php

namespace App\Domains\Order\Events;

use App\Events\BaseEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Domains\Order\Models\Order;

class OrderCreated extends BaseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count;

    /**
     * @param array $data 
     */
    public function __construct($order)
    {
        $this->count = Order::where('status', 'Pending')->count();
        $this->createOperation('create', 'order', $order->code);
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