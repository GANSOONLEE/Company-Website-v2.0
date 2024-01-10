<?php

namespace App\Domains\Cart\Services;

use App\Domains\Cart\Models\Cart;

use App\Exceptions\GeneralException;

use App\Services\BaseService;

use Illuminate\Support\Facades\DB;

class CartService extends BaseService
{
    
    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    /**
     * Create cart record
     * 
     * @param array $data
     * 
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
            throw new GeneralException ($e->getMessage());
        }

        DB::commit();
        return $cart;
    }

    /**
     * Update cart record
     * 
     * @param string $brand
     * @param array $data
     * 
     * @return void
     */
    public function update(string $brand, array $data = []): void
    {
        DB::beginTransaction();
        
        try{
            $this->model->where('user_email', auth()->user()->email)
                ->where('sku_id', $brand)
                ->update([
                    'number' => $data['quantity'],
                ]);

        }catch(\Exception $e) {
            DB::rollBack();
            throw new GeneralException ("There was a problem updating the cart.");
        }

        DB::commit();
    }
        
    /**
     * Method delete
     *
     * @param string $brand
     *
     * @return void
     */
    public function delete(string $brand): void
    {
        $this->model->where('user_email', auth()->user()->email)
            ->where('sku_id', $brand)
            ->delete();
    }
        
    /**
     * Method delete
     *
     * @param string $searchTerm
     *
     * @return mixed
     */
    public function searchByText(string $searchTerm): mixed
    {
        return auth()->user()
            ->cart()
            ->byProductName()
            ->where(function ($query) use ($searchTerm) {
                $query->where('products_name.name', 'LIKE', "%$searchTerm%")
                    ->orWhere('products_brand.brand', 'LIKE', "%$searchTerm%")
                    ->orWhere('carts.sku_id', 'LIKE', "%$searchTerm%");
            })
            ->paginate(10)
            ->withQueryString();
    }
        
    /**
     * Method delete
     *
     * @param array $searchTerm
     *
     * @return mixed
     */
    public function searchByCategories(array $searchTerm): mixed
    {
        return auth()->user()
            ->cart()
            ->byProductName()
            ->whereIn('products.product_category', $searchTerm)
            ->paginate(10)
            ->withQueryString();
    }

}