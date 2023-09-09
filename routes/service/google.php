<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SocialiteController;

Route::group(['prefix' => 'google', 'as' => 'google.'], function(){
    
    Route::get('auth', [SocialiteController::class, 'redirectToProvider'])
        ->name('auth');

    Route::get('auth/callback', [SocialiteController::class, 'handleProviderCallback'])
        ->name('auth.callback');
});