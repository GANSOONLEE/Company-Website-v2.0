<?php

namespace App\Domains\Order\Http\Controllers;

// Service
use App\Domains\Order\Services\OrderService;

// Request
use Illuminate\Http\Request;
use App\Domains\Order\Request\CreateOrderRequest;
use App\Domains\Order\Request\UpdateOrderRequest;

// Model
use App\Domains\Order\Models\Order;

class OrderController
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Get the view for view order
     * @return mixed
     */
    public function index(): mixed
    {
        return view('backend.admin.order.index');
    }

    /**
     * Get the view for order history
     * @return mixed
     */
    public function list(): mixed
    {
        return view('backend.admin.order.list');
    }

    /**
     * Get the view for create order [User Backend]
     * @return mixed
     */
    public function create(): mixed
    {
        return view('backend.user.order.create');
    }

    /**
     * Post order data to create order
     * @param CreateOrderRequest $request
     * @return mixed
     */
    public function store(CreateOrderRequest $request): mixed
    {
        $array = json_decode($request->selectedCheckbox);
        $arrayWithoutRow = array_map(function($element) {
            return str_replace("row-", "", $element);
        }, $array);

        $this->orderService->store($arrayWithoutRow);
        return redirect()->back()->with('success', 'Your order has successful create !');
    }

    /**
     * Get the view for order detail
     */
    public function detail($id): mixed
    {
        $order = Order::where('id', $id)->first();
        return view('backend.admin.order.detail', compact('order'));
    }

    /**
     * Get the view for edit order [User Backend]
     * @return mixed
     */
    public function edit(): mixed
    {
        return view('backend.user.order.edit');
    }

    /**
     * Patch order data to update order
     * @param string $id
     * @param UpdateOrderRequest $request
     * @return mixed
     */
    public function update(string $id, UpdateOrderRequest $request): mixed
    {
        $this->orderService->update($id, $request->validated());
        return redirect()->back()->with('success', 'Your order has successful update !');
    }

    /**
     * Soft delete order data (Can Restore)
     * @param string $id
     * @return mixed
     */
    public function delete(string $id): mixed
    {
        $this->orderService->delete($id);
        return redirect()->back();
    }

    /**
     * Force delete order data (Can't Restore)
     * @param string $id
     * @return mixed
     */
    public function destroy(string $id): mixed
    {
        $this->orderService->destroy($id);
        return redirect()->back();
    }

    /* 
     | -----------------------------------------------
     | 
     |                    User 用戶
     | 
     | -----------------------------------------------
     */

    /**
     * [Get] View Order
     */
    public function userList()
    {
        $orders = auth()->user()->order()->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.user.order.index', compact('orders'));
    }

    
    /**
     * Get the view for order detail
     */
    public function detailUser($id): mixed
    {
        $order = Order::where('id', $id)->where('user_email', auth()->user()->email)->first();
        return view('backend.user.order.detail', compact('order'));
    }

}