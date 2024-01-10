<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Order\Http\Controllers\OrderController;
use App\Domains\Document\Http\Controllers\DocumentController;

Route::group(['prefix' => 'order', 'as' => 'order.'], function(){

    // View Order [View]
    Route::get('index', [OrderController::class, 'index'])
        ->name('index');
    
    // Order History [View]
    Route::get('list', [OrderController::class, 'list'])
        ->name('list');

    // Create Order [View]
    Route::get('create', [OrderController::class, 'create'])
        ->name('create');

    // View Order Detail [Action]
    Route::get('/detail/{id}', [OrderController::class, 'detail'])
        ->name('detail');

    // Edit Order [View]
    Route::get('edit', [OrderController::class, 'edit'])
        ->name('edit');

    // Modify Order [Action]
    Route::patch('{id}', [OrderController::class, 'update'])
        ->name('update');

    // Soft Delete Order [Action]
    Route::delete('{id}', [OrderController::class, 'delete'])
        ->name('delete');

    // Force Delete Order [Action]
    Route::delete('/deleted/{id}', [OrderController::class, 'destroy'])
        ->name('destroy');

    /*
     | ---------------------------------------------------------
     | 
     |                       文檔 Document
     | 
     | ---------------------------------------------------------
     */
    Route::group(['prefix' => 'document', 'as' => 'document.'], function() {
            
        Route::get('/pdf/{orderId}', [DocumentController::class, 'pdf'])
            ->name('pdf');
            
        Route::get('/print/pdf/{orderId}', [DocumentController::class, 'pdf'])
            ->name('pdf');

    });

});