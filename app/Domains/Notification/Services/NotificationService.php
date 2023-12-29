<?php

namespace App\Domains\Notification\Services;

use App\Domains\Notification\Event\NotificationCreated;

use App\Services\BaseService;

use Illuminate\Support\Facades\Log;


class NotificationService extends BaseService
{

    public function __construct()
    {
        
    }

    /**
     * Publish messages via pusher
     * @param array $data
     * @return mixed
     */
    public function publish(array $data = []): mixed
    {
        event(new NotificationCreated($data));
        return $data;
    }

}