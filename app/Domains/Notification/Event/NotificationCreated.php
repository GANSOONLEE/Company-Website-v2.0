<?php

namespace App\Domains\Notification\Event;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messages;
    public $duration;

    /**
     * @param array $data 
     */
    public function __construct(array $data = [])
    {
        $this->messages = $data['messages'];
        $this->duration = $data['duration'] ?? 5000;
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
        return 'notification.created';
    }
}