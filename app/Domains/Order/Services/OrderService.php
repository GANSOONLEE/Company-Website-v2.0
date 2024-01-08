<?php

namespace App\Domains\Order\Services;

use App\Services\BaseService;

// Event
use App\Domains\Order\Events\OrderCreated;
use App\Domains\Order\Events\OrderUpdated;
use App\Domains\Order\Events\OrderDeleted;

// Model
use App\Domains\Order\Models\Order;
use App\Domains\Cart\Models\Cart;

// Exceptions
use Exception;
use App\Exceptions\GeneralException;

// Laravel Support
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * Generate a unique order code
     * @return string
     */
    public function generateOrderCode(): string
    {
        $code = Str::random(8);

        if(Order::where('code', $code)->exists()){
            $this->generateOrderCode();
        }

        return $code;
    }

    /**
     * Store the order data
     * @param array $data
     * @return Order
     */
    public function store(array $data = []): Order
    {
        
        DB::beginTransaction();
        
        try{
            $order = $this->createOrder([
                'code' => $this->generateOrderCode(),
                'status' => 'Pending',
                'user_email' => auth()->user()->email,  
            ], $data);
    
        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException($e->getMessage()); // "There was a problem creating the order."
        }

        DB::commit();
        return $order;
    }

    /**
     * Create the order data
     * @param array $data
     * @param array $orderDetailData
     * @return Order
     */
    public function createOrder(array $data, array $orderDetailData = []): Order
    {
        DB::beginTransaction();

        try{
            // Save order basic information
            $order = $this->model->create([
                'code' => $data['code'] ?? null,
                'status' => $data['status'] ?? null,
                'user_email' => $data['user_email'] ?? null,
            ]);
            
            // Save order detail
            foreach ($orderDetailData as $id)
            {
                $cart = Cart::where('id', $id)->first();
                $number = $cart->number;
                
                if($number === 0){
                    throw new GeneralException('The item quantity can\'t be 0!');
                }

                DB::table('orders_detail')
                    ->insert([
                        'order_id' => $data['code'],
                        'sku_id' => $cart->sku_id,
                        'number' => $cart->number,
                    ]);

                $cart->update(['number' => 0]);
            }

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException($e->getMessage());
        }

        DB::commit();
        event(new OrderCreated($order));
        return $order;

    }

    /**
     * Updates the order
     * @param string $id
     * @param array $data
     */
    public function update(string $id, array $data = [])
    {
        DB::beginTransaction();

        try {
            DB::table('orders_detail')
                ->where('id', $id)
                ->update([
                    "remarks" => $data["remark"] ?? null,
                ]);

        }catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        DB::commit();
    }

    /**
     * [Delete] the order temporary
     * 
     * @param string $id
     * 
     * @return void
     */
    public function delete(string $id): void
    {
        $this->model->find($id)->delete();
    }

    /**
     * [Delete] the order forever
     * 
     * @param string $id
     * 
     * @return void
     */
    public function destroy(string $id): void
    {
        $this->model->find($id)->forceDelete();
    }

    /*
    | ---------------------------------------------------------
    |
    |                        用戶   User
    |
    | ---------------------------------------------------------
    */

    /**
     * @param string $id
     * @param array $data
     */
    public function addItem(string $id, array $data = [])
    {
        DB::beginTransaction();

        try{
            $order = $this->model->find($id);

            $order->detail()->insert([
                "order_id" => $order->code,
                "sku_id" => $data['brand'],
                "number" => $data['quantity'],
                "remarks" => null,
            ]);
        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException('There was a problem to adding your item to order.');
        };

        DB::commit();
    }

}