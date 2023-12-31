<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Model\ModelController;

Route::group(['prefix' => 'model', 'as' => 'model.'], function()
{

    /** Disuse - Panel*/
    // Route::get('/', [ModelController::class, 'index'])
    //     ->name('index');
    
    Route::get('create', [ModelController::class, 'create'])
        ->name('create');

    Route::post('/', [ModelController::class, 'store'])
        ->name('store');

    Route::get('edit', [ModelController::class, 'edit'])
        ->name('edit');


    Route::patch('{id}', [ModelController::class, 'update'])
        ->name('update');


    Route::delete('{id}', [ModelController::class, 'destroy'])
        ->name('destroy');

});