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
        $carts = auth()->user()->cart()->byProductName()->paginate(10);
        return view('backend.user.cart.create', compact('carts'));
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
     * [Get] Cart data search by text
     * @return mixed
     */
    public function searchByText(Request $request): mixed
    {
        if(isset($request->searchTerm)){
            $carts = $this->cartService->searchByText($request->searchTerm);
            return view('backend.user.cart.create', compact('carts'));
        }
        return redirect()->route('backend.user.cart.create');
    }

    /**
     * [Get] Cart data search by category
     * @return mixed
     */
    public function searchByCategory(Request $request): mixed
    {
        if(isset($request->categories)){
            $carts = $this->cartService->searchByCategories($request->categories);
            return view('backend.user.cart.create', compact('carts'));
        }
        return redirect()->route('backend.user.cart.create');
    }

    /**
     * [Patch] Cart data to update
     * @return void
     */
    public function update(string $brand, UpdateCartRequest $request): void
    {
        $this->cartService->update($brand, $request->validated());
    }

    /**
     * [Delete] Cart data to delete
     * 
     * @param string $brand
     * @return mixed
     */
    public function delete(string $brand): mixed
    {
        $this->cartService->delete($brand);
        return response()->json(['message' => 'Cart deleted successfully!']);
    }
}