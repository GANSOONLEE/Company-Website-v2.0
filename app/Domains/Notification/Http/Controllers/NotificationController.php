<?php

namespace App\Domains\Notification\Http\Controllers;

// Service
use App\Domains\Notification\Services\NotificationService;

use App\Domains\Notification\Event\NotificationCreated;

// Laravel Support
use Illuminate\Http\Request;

class NotificationController
{

    public $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Get [View] of Publish Notification
     */
    public function index(): mixed
    {
        return view('backend.admin.notification.index');
    }

    /**
     * Post Message of Publish Notification
     */
    public function publish(Request $request): mixed
    {
        $data = $this->notificationService->publish($request->all());
        return redirect()->back()->with('success', trans('notification.publish-successful', ["messages" => $data['messages'], "duration" => $data['duration']]));
    }

}
