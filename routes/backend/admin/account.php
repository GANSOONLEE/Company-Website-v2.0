<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Account\UserManagementController;
use App\Http\Controllers\Backend\Admin\Account\RoleManagementController;
use App\Http\Controllers\Backend\Admin\Account\PermissionManagementController;
use App\Http\Controllers\Backend\Admin\Account\AccountBannedController;
use App\Http\Controllers\Backend\Admin\Account\UserOperationController;

Route::group(['prefix' => 'account', 'as' => 'account.'], function(){

    // GET
    Route::get('user-management', [UserManagementController::class,'userManagement'])
        ->name('user.management');

    Route::get('role-management', [RoleManagementController::class,'roleManagement'])
        ->name('role.management');

    Route::get('permission-management', [PermissionManagementController::class,'permissionManagement'])
        ->name('permission.management');

    Route::get('account-banned', [AccountBannedController::class,'accountBanned'])
        ->name('account.banned');

    Route::get('user-operation', [UserOperationController::class,''])
        ->name('user.operation');


});