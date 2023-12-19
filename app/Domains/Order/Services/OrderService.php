<?php

namespace App\Domains\Order\Services;

use App\Services\BaseService;

// Event

// Model
use App\Domains\Order\Models\Order;

// Exceptions
use Exception;
use App\Exceptions\GeneralException;

// Laravel Support
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
        return Order::where('code', $code)->exists() ? $code : $this->generateOrderCode();
    }

    /**
     * Store the order data
     * @param array $data
     * @return Order
     */
    public function store(array $data = []): Order
    {
        // Pack in data
        dd($data);

        return $this->createOrder([
            'code' => $this->generateOrderCode(),
            'status' => 'Pending',
            'user_email' => auth()->user()->email,  
        ], );
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
            foreach ($orderDetailData as $array)
            {
                DB::table('order_details')
                ->insert([
                    'order_id' => $data['code'],
                    'sku_id' => $array->sku_id,
                    'number' =>$array->number,
                ]);
            }

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException('There was an problem creating the order, please try again.');
        }


        DB::commit();
        return $order;

    }
}