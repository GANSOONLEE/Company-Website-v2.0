<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Category\EditCategoryController;
use App\Http\Controllers\Backend\Admin\Category\CreateCategoryController;
use App\Domains\Category\Events\CategoryUpdateEvent;
use App\Domains\Category\Events\CategoryCreateEvent;

Route::group(['prefix' => 'category', 'as' => 'category.'], function(){

    // Select
    Route::get('category-create/list', [CreateCategoryController::class, 'createCategory'])
        ->name('category-create');

    Route::get('category-edit/list', [EditCategoryController::class, 'editCategory'])
        ->name('category-edit');

    // Update
    Route::put('update-category', [CategoryUpdateEvent::class, 'categoryUpdate'])
        ->name('update');

    // Create
    Route::post('create-category', [CategoryCreateEvent::class, 'categoryCreate'])
        ->name('create');

    // Delete

});