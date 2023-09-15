<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Admin\Brand\EditBrandController;
use App\Http\Controllers\Backend\Admin\Brand\CreateBrandController;

Route::group(['prefix' => 'brand', 'as' => 'brand.'], function(){

    Route::get('brand-edit', [EditBrandController::class, 'editbrand'])
        ->name('brand-edit');

    Route::get('brand-create', [CreateBrandController::class, 'createbrand'])
        ->name('brand-create');

});