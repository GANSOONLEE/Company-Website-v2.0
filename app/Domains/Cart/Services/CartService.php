<?php

namespace App\Domains\Cart\Services;

use App\Services\BaseService;

use App\Domains\Cart\Models\Cart;

use App\Exceptions\GeneralException;

use Illuminate\Support\Facades\DB;

class CartService extends BaseService
{
    
    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    /**
     * Create cart record
     * @param array $data
     * @return Cart
     */
    public function store(array $data = []): Cart
    {
        DB::beginTransaction();

        try{

            $email = auth()->user()->email;

            // check exists
            $cart = Cart::where('user_email', $email)
                        ->where('sku_id', $data['brand'])
                        ->first();

            if($cart){
                $cart->update([
                    "number" => intval($data['quantity']) + $cart->number,
                ]);
            }else{
                $cart = $this->model::create([
                    "sku_id" => $data['brand'],
                    "number" => $data['quantity'],
                    'user_email' => $email ?? null,
                ]);
            }
        }catch(\Exception $e) {
            DB::rollBack();
            throw new GeneralException ("There was a problem creating the cart.");
        }

        DB::commit();
        return $cart;
    }

    /**
     * Create cart record
     * @param array $data
     * @return void
     */
    public function update(array $data = []): void
    {
        $cart = $this->model->where('user_email', auth()->user()->email)
            ->where('id', $data['id'])
            ->first();

        DB::beginTransaction();
            $cart->update([
                'number' => $data['quantity'],
            ]);
        try{

        }catch(\Exception $e) {
            DB::rollBack();
            throw new GeneralException ("There was a problem creating the cart.");
        }

        DB::commit();
    }

}