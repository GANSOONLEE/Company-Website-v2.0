<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Account\UserManagementController;
use App\Http\Controllers\Backend\Admin\Account\RoleManagementController;
use App\Http\Controllers\Backend\Admin\Account\PermissionManagementController;
use App\Http\Controllers\Backend\Admin\Account\AccountBannedController;
use App\Http\Controllers\Backend\Admin\Account\UserOperationController;
use App\Domains\Account\Events\UserUpdateEvent;
use App\Domains\Account\Events\RoleCreateEvent;
use App\Domains\Account\Events\RoleUpdateEvent;
use App\Domains\Account\Events\PermissionUpdateEvent;
use App\Domains\Account\Events\BannedUnbannedEvent;

Route::group(['prefix' => 'account', 'as' => 'account.'], function(){

    // Get
    Route::get('user-management/list', [UserManagementController::class,'userManagement'])
        ->name('user.management');

    Route::get('role-management/list', [RoleManagementController::class,'roleManagement'])
        ->name('role.management');

    Route::get('permission-management/list', [PermissionManagementController::class,'permissionManagement'])
        ->name('permission.management');

    Route::get('account-banned/list', [AccountBannedController::class,'accountBanned'])
        ->name('account.banned');

    Route::get('user-operation/list', [UserOperationController::class,'userOperation'])
        ->name('user.operation');

    // Put
    Route::put('update-user', [UserUpdateEvent::class, 'updateUser'])
        ->name('update-user');

    Route::put('update-role', [RoleUpdateEvent::class, 'updateRole'])
        ->name('update-role');

    Route::put('update-permission', [PermissionUpdateEvent::class, 'updatePermission'])
        ->name('update-permission');

    Route::put('banned-unbanned-account', [BannedUnbannedEvent::class, 'bannedUnbanned']);

    // Post
    Route::post('create-role', [RoleCreateEvent::class, 'createRole'])
        ->name('create-role');
    
});