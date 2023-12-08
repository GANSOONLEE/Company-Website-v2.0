<?php

use Illuminate\Support\Facades\Route;

use App\Domains\Cart\Events\CreateCartEvent;
use App\Domains\Product\Services\SearchProductService;

Route::group(['prefix'=>'product', 'as'=>'product.'], function(){

    Route::post('detail/{productCode}', [CreateCartEvent::class, 'createCart'])->name('detail.post');
    Route::get('search/{productCategory}/post', [SearchProductService::class, 'searchProduct'])->name('search.post');

});