<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Pusher\Pusher;

class NewOrderEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $orderNewCount;

    public function __construct($orderNewCount)
    {
        $this->orderNewCount = $orderNewCount;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {   
        $pusher = new Pusher('a5467f403d2b33859816', '9d3d31e524792ea36059', '1699531');
        $pusher->trigger('create-order-channel', 'App\\Events\\NewOrderEvent' ,$this->orderNewCount);

        return [
            new Channel('create-order-channel'),
        ];
    }
}
