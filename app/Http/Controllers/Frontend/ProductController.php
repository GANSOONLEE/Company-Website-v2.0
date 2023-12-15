<?php

namespace App\Http\Controllers\Frontend;

// Laravel Support
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// Model
use App\Domains\Product\Models\Product;
use App\Models\CarModel;

use App\Domains\Product\Services\FrontendProductService;
use Illuminate\Http\Request;

class ProductController extends Controller{

    protected $frontendProductService;
    protected $modelData;

    public function __construct(FrontendProductService $frontendProductService)
    {
        $this->frontendProductService = $frontendProductService;
        $this->modelData = CarModel::orderBy('name', 'asc')->get();
    }

    /**
     * route: frontend.product.list
     * @param string $category
     * 
     * @return mixed
     */
    public function list(string $category): mixed
    {
        $productData = $this->frontendProductService->list($category);
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
        $data = ['category'=> $category,'model'=> $model,];
        $productData = $this->frontendProductService->searchProductByCategoryAndCarModel($data);

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

        $productData = $this->frontendProductService->search($searchTerm);
        return view('frontend.product-search', compact('productData'));
    }

}