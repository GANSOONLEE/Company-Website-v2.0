
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\User\UserViewCartController;

use App\Domains\Cart\Events\UserSearchCartEvent;

Route::get('/cart', [UserViewCartController::class, 'userViewCart'])->name('cart');

Route::group(['prefix' => 'cart', 'as' => 'cart.'], function(){

    Route::get('search/cart', [UserSearchCartEvent::class, 'searchCart'])->name('search-cart');
});