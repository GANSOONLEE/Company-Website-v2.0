<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Account\Events\UserUpdateEvent;
use App\Domains\Account\Events\RoleCreateEvent;
use App\Domains\Account\Events\RoleUpdateEvent;
use App\Domains\Account\Events\PermissionUpdateEvent;

Route::group(['prefix' => 'account', 'as' => 'account.'], function(){

    // POST
    Route::post('update-user', [UserUpdateEvent::class, 'updateUser'])->name('update-user');

    Route::post('create-role', [RoleCreateEvent::class, 'createRole'])->name('create-role');
    Route::post('update-role', [RoleUpdateEvent::class, 'updateRole'])->name('update-role');
    
    Route::post('update-permission', [PermissionUpdateEvent::class, 'updatePermission'])->name('update-permission');

});