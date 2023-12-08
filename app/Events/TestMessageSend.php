<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestMessageSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //指定queue
    public $broadcastQueue = 'test';
    private $broadcastType;
    private $broadcastName;


    /**
     * @param $messageSendData
     */
    public function __construct()
    {
        $this->broadcastName = 'private-product-detail-channel';
    }

    /**
     * 指定廣播頻道
     * @return Channel|array
     */
    public function broadcastOn()
    {
            return new PrivateChannel($this->broadcastName);
    }

    /**
     * 傳送內容
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'content' =>'test message'
        ];
    }
}