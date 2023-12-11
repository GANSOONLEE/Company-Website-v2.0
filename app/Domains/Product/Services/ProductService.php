<?php

namespace App\Domains\Product\Services;

use App\Services\BaseService;
use App\Exceptions\GeneralException;
use App\Domains\Product\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

use App\Domains\Product\Events\ProductCreated;
use App\Domains\Product\Events\ProductUpdated;
use App\Domains\Product\Events\ProductDeleted;
use App\Domains\Product\Events\ProductRestored;
use App\Domains\Product\Events\ProductDestroyed;

use App\Domains\Product\Services;

class ProductService extends BaseService
{

    public $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @param Product $product
     * 
     * @return mixed
     */
    public function registerProduct(array $data = []): Product
    {

        DB::beginTransaction();

        try{
            $product = $this->createProduct($data);
        }catch (Exception $e){
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your product.'));
        }

        event(new ProductCreated($product));

        DB::commit();
        return $product;

    }

    /**
     * @param array $data
     * 
     * @return Product
     * @throws GeneralException
     */
    public function store(array $data = []): Product
    {
        DB::beginTransaction();

        try{
            $product = $this->createProduct([
                'product_code' => $data['product_code'],
                'product_category' => $data['product_category'] ?? null,
                'product_status' => $data['product_status'] ?? null,
            ]);

        }catch(Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating your problem\. Please try again.'));
        }

        DB::commit();
        return $product;
    }
    
    public function createProduct(array $data = []): Product
    {
        return $this->model::create([
            'product_code' => $data['product_code'],
            'product_category' => $data['product_category'] ?? null,
            'product_status' => $data['product_status'] ?? null,
        ]);
    }

}