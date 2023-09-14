<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Category\EditCategoryController;
use App\Http\Controllers\Backend\Admin\Category\CreateCategoryController;

Route::group(['prefix' => 'category', 'as' => 'category.'], function(){

    Route::get('category-edit', [EditCategoryController::class, 'editCategory'])
        ->name('category-edit');

    Route::get('category-create', [CreateCategoryController::class, 'createCategory'])
        ->name('category-create');

});