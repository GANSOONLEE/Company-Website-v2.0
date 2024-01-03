<?php

namespace App\Domains\Cart\Http\Controllers;

// Service

use App\Domains\Cart\Models\Cart;
use App\Domains\Cart\Services\CartService;

// Request
use App\Domains\Cart\Request\CreateCartRequest;
use App\Domains\Cart\Request\UpdateCartRequest;

// Laravel Support
use Illuminate\Http\Request;

class CartController
{
    /**
     * @var
     */

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Get the view for create order [User Backend]
     * @return mixed
     */
    public function create(): mixed
    {
        return view('backend.user.cart.create');
    }

    /**
     * [Post] Cart data to store
     * @return mixed
     */
    public function store(CreateCartRequest $request): mixed
    {
        $this->cartService->store($request->validated());
        $count = Cart::where('user_email', auth()->user()->email)->where('number', '>', '0')->count();
        return response()->json(["count" => $count]);
    }

    /**
     * [Patch] Cart data to update
     * @return void
     */
    public function update(UpdateCartRequest $request): void
    {
        $this->cartService->update($request->validated());
    }
}