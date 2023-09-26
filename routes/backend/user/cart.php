
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\User\UserViewCartController;

Route::get('/cart', [UserViewCartController::class, 'userViewCart'])->name('cart');

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function(){

    

});