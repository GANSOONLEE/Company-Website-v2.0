<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Http\Controllers\UserController;
use App\Domains\Auth\Http\Controllers\RoleController;
use App\Domains\Auth\Http\Controllers\PermissionController;

use Yajra\DataTables;

Route::group(['prefix' =>'user', 'as' =>'user.'], function()
{

    Route::get('/', [UserController::class, 'index'])
        ->name('index');

    Route::get('create', [UserController::class, 'create'])
        ->name('create');

    Route::get('management/{page?}', [UserController::class, 'management'])
        ->name('management');

    Route::get('permission', [UserController::class, 'permission'])
        ->name('permission');

    Route::get('ban', [UserController::class, 'ban'])
        ->name('ban');

    Route::post('/', [UserController::class,'store'])
        ->name('store');

    Route::get('edit', [UserController::class, 'edit'])
        ->name('edit');

    Route::patch('{user}', [UserController::class, 'update'])
        ->name('update');

    Route::delete('{user}', [UserController::class, 'delete'])
    ->name('delete');

    Route::delete('/deleted-user/{user}', [UserController::class, 'destroy'])
        ->name('destroy');

});

Route::group(['prefix' =>'role', 'as' =>'role.'], function()
{

    Route::get('/', [RoleController::class, 'index'])
        ->name('index');

    Route::get('create', [RoleController::class, 'create'])
        ->name('create');

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

    Route::get('create', [PermissionController::class, 'create'])
        ->name('create');

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