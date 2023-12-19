<?php

namespace App\Domains\Cart\Http\Controllers;

// Service
use App\Domains\Cart\Services\CartService;

// Request

// Laravel Support

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
}