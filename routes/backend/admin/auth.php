<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Http\Controllers\UserController;
use App\Domains\Auth\Http\Controllers\RoleController;
use App\Domains\Auth\Http\Controllers\PermissionController;

Route::group(['prefix' =>'user', 'as' =>'user.'], function()
{

    // User Management Center
    Route::get('/', [UserController::class, 'index'])
        ->name('index');

    // User Management Center > Create Panel
    Route::get('create', [UserController::class, 'create'])
        ->name('create');

    // User Management Center > Management Panel
    Route::get('management/{page?}', [UserController::class, 'management'])
        ->name('management');

    Route::get('search', [UserController::class, 'search'])
        ->name('search');

    // User Management Center > Permission Panel
    Route::get('permission', [UserController::class, 'permission'])
        ->name('permission');

    // User Management Center > Ban Panel
    Route::get('ban', [UserController::class, 'ban'])
        ->name('ban');

    Route::get('get/{email}', [UserController::class, 'get'])
        ->name('get');

    // Store User
    Route::post('/', [UserController::class,'store'])
        ->name('store');

    // Restore User
    Route::patch('restore/{id}', [UserController::class, 'restore'])
        ->name('restore');

    // Update User
    Route::patch('{userID}', [UserController::class, 'update'])
        ->name('update');

    // Delete User (Soft)
    Route::delete('{id}', [UserController::class, 'delete'])
        ->name('delete');

    // Delete User (Force)
    Route::delete('/deleted-user/{id}', [UserController::class, 'destroy'])
        ->name('destroy');

});

Route::group(['prefix' =>'role', 'as' =>'role.'], function()
{

    Route::get('/', [RoleController::class, 'index'])
        ->name('index');

    Route::get('create', [RoleController::class, 'create'])
        ->name('create');

    Route::get('management', [RoleController::class, 'management'])
        ->name('management');

    Route::post('/', [RoleController::class,'store'])
        ->name('store');

    Route::get('edit', [RoleController::class, 'edit'])
        ->name('edit');

    Route::patch('{user}', [RoleController::class, 'update'])
        ->name('update');

    Route::delete('{user}', [RoleController::class, 'delete'])
    ->name('delete');

    Route::delete('/deleted-user/{user}', [RoleController::class, 'destroy'])
        ->name('destroy');

});

Route::group(['prefix' =>'permission', 'as' =>'permission.'], function()
{

    Route::get('/', [PermissionController::class, 'index'])
        ->name('index');

    Route::get('management', [PermissionController::class, 'management'])
        ->name('management');

    Route::post('/', [PermissionController::class,'store'])
        ->name('store');

    Route::get('edit', [PermissionController::class, 'edit'])
        ->name('edit');

    Route::patch('{user}', [PermissionController::class, 'update'])
        ->name('update');

    Route::delete('{user}', [PermissionController::class, 'delete'])
    ->name('delete');

    Route::delete('/deleted-user/{user}', [PermissionController::class, 'destroy'])
        ->name('destroy');

});