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

            dd(auth()->user()->email);

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
                    "number" => intval($data['quantity']),
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

}