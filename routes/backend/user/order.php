<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'order', 'as' => 'order.'], function(){

    // GET
    Route::get('/',[])->name('index');

});
