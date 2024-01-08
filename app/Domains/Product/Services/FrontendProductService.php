<?php

namespace App\Domains\Product\Services;

use App\Services\BaseService;
use App\Domains\Product\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FrontendProductService extends BaseService
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
     * List all products
     * @param string $category
     * 
     */
    public function list(string $category, int $recordsPerPage = 30)
    {
        return Product::where('product_category', $category)
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->orderBy('products_name.name')
            ->paginate($recordsPerPage);

    }

    /**
     * Search product by Category and Car Model
     * @param array $data
     * 
     */
    public function searchProductByCategoryAndModel(array $data = [], int $recordsPerPage = 30)
    {
        return Product::where('product_category', $data['category'])
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->where('products_name.name', 'LIKE', "%" . $data['model'] . "%")
            ->orderBy('products_name.name')
            ->paginate($recordsPerPage);
    }

    /**
     * Search product at global
     * @param string $searchTerm
     * 
     * @return mixed
     */
    public function search(string $searchTerm): mixed
    {
        return Product::select('products.*')
            ->addSelect(DB::raw('GROUP_CONCAT(DISTINCT products_name.name) as names'))
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->leftJoin('products_brand', 'products_brand.product_code', '=', 'products.product_code')
            ->where(function ($query) use ($searchTerm) {
                $query->where('products_name.name', 'like', "%$searchTerm%")
                    ->orWhere('products_brand.brand', 'like', "%$searchTerm%")
                    ->orWhere('products_brand.code', 'like', "%$searchTerm%")
                    ->orWhere('products_brand.frozen_code', 'like', "%$searchTerm%")
                    ->orWhere('products.product_category', 'like', "%$searchTerm%");
            })
            ->orderBy('products_name.name')
            ->groupBy('products.product_code')
            ->get();
    }
}