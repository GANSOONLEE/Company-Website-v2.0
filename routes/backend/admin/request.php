<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Request\Events\GetProductData;

Route::group(['prefix' => 'request', 'as' => 'request.'], function(){

    Route::post('getProductData', [GetProductData::class , 'getProductData'])->name('');

});