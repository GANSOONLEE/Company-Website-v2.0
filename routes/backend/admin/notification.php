<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Notification\Http\Controllers\NotificationController;

Route::group(['prefix' => 'notification', 'as' => 'notification.'], function(){

    Route::get('/', [NotificationController::class, 'index'])
        ->name('index');

    Route::post('publish', [NotificationController::class, 'publish'])
        ->name('publish');

});