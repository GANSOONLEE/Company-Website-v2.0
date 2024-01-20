<?php

namespace App\Http\Controllers\Frontend;

// Laravel Support
use App\Http\Controllers\Controller;

// Model
use App\Domains\Model\Models\Model;

// Service
use App\Domains\Cart\Services\CartService;
use App\Domains\Product\Services\FrontendProductService;

// Request
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $frontendProductService;
    protected $cartService;
    protected $modelData;

    public function __construct(FrontendProductService $frontendProductService, CartService $cartService)
    {
        $this->frontendProductService = $frontendProductService;
        $this->cartService = $cartService;
        $this->modelData = Model::orderBy('name', 'asc')->get();
    }

    /**
     * route: frontend.product.list
     * @param string $category
     * 
     * @return mixed
     */
    public function list(string $category): mixed
    {
        $productData = $this->frontendProductService->list($category, 48);
        $directory = "storage/product/$category";
        $modelData = $this->modelData;
        
        return view('frontend.product', compact('productData', 'directory', 'modelData', 'category'));
    }

    /**
     * route: frontend.product.query
     * Search product by Category and Model
     * @param string $category
     * @param string $model
     * 
     * @return mixed
     */
    public function query(string $category, string $model): mixed
    {
        $category = str_replace('&amp;amp;', '&', $category);
        $data = ['category'=> $category, 'model'=> $model];
        $productData = $this->frontendProductService->searchProductByCategoryAndModel($data, 48);

        // Defined variable
        $directory = "storage/product/$category";
        $modelData = $this->modelData;

        return view('frontend.product', compact('productData', 'directory', 'modelData', 'category', 'model'));
    }

    /**
     * Search product by all columns
     * @param Request $request
     * 
     * @return mixed;
     */
    public function search(Request $request): mixed
    {
        $searchTerm = $request->searchTerm;
        if($searchTerm === null){
            return redirect()->route('frontend.product.index');
        }

        $products = $this->frontendProductService->search($searchTerm);

        $productData = [];
        foreach($products as $product) {
            $productData[$product->product_category][] = $product;
        };

        return view('frontend.product-search', compact('productData'));
    }

}