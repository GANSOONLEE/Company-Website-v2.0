<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Auth\Http\Controllers\UserController;

Route::group(['prefix' =>'user', 'as' =>'user.'], function()
{

    Route::get('/', [UserController::class, 'index'])
        ->name('index');

    Route::get('create', [UserController::class, 'create'])
        ->name('create');

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