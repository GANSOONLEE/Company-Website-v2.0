<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Events\VerifyEmailEvent;

Route::group(['prefix' => 'email', 'as' => 'email.',], function(){

    Route::get('activate/user', [VerifyEmailEvent::class, 'verifyEmail'])->name('activate');

});