<?php

namespace App\Domains\Product\Http\Controllers;

// Request
use Illuminate\Http\Request;
use App\Domains\Product\Request\CreateProductRequest;
use App\Domains\Product\Request\UpdateProductRequest;

// Service
use App\Domains\Product\Services\ProductService;

// Model
use App\Domains\Product\Models\Product;

use Yajra\DataTables\DataTables;
use App\DataTables\ProductsDataTable;
use Illuminate\Support\Facades\Storage;

class ProductController
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * url: admin/product/
     * method: get
     * name: backend.admin.product.index
     * 
     * @return \Illuminate\View\View;
     */
    public function index(): \Illuminate\View\View
    {
        return view('backend.admin.product.product-panel');
    }

    /**
     * url: admin/product/create
     * method: get
     * name: backend.admin.product.create
     * 
     * @return mixed
     */
    public function create(): mixed
    {
        return view('backend.admin.product.create');
    }

    /**
     * url: admin/product/management
     * method: get
     * name: backend.admin.product.management
     * 
     * @return mixed
     */
    public function management(): mixed
    {
        $productData = Product::select('products.*', 'products_name.name')
            ->leftJoin('products_name', 'products_name.product_code', '=', 'products.product_code')
            ->orderBy('products.product_category', 'asc')
            ->orderBy('products_name.name', 'asc')
            ->groupBy('products.id')
            ->paginate(10);

        return view('backend.admin.product.management', compact('productData'));
    }

    /**
     * url: admin/product/edit/{id}
     * method: get
     * name: backend.admin.product.edit
     * @param string $id
     * 
     * @return mixed
     */
    public function edit(string $id): mixed
    {
        $product = Product::where('id', $id)->first();

        return view('backend.admin.product.edit', compact('product'));
    }

    /**
     * url: admin/product/store
     * method: post
     * name: backend.admin.product.store
     * 
     * @param CreateProductRequest $request
     * 
     * @return mixed
     */
    public function store(CreateProductRequest $request): mixed
    {
        $this->productService->store($request->validated());
        return redirect()->back()->with('success', __('product.create-product-success'));
    }

    /**
     * url: admin/product/
     * method: patch
     */
    public function update($id, UpdateProductRequest $request): mixed
    {
        $this->productService->update($id, $request->validated());
        return redirect()->back()->with('success', __('product.update-product-success'));
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
            return redirect()->route('backend.admin.product.management');
        }

        $productData = $this->productService->search($searchTerm);
        return view('backend.admin.product.management', compact('productData'));
    }

    /**
     * Force delete Product/Brand Image
     * @param Request $request
     * 
     * @return mixed|void
     */
    public function destroyImage(Request $request)
    {
        try{
            
            $url = $request->link;

            $path = parse_url($url, PHP_URL_PATH);

            $relativePath = str_replace('storage/', '', urldecode($path));

            $debug = Storage::disk('public')->delete(stripslashes($relativePath));

        }catch(\Exception $e){
            
        }

        return response()->json(['debug' => $debug, 'relativePath' => stripslashes($relativePath)]);
    }

    /**
     * Delete the Product Information (Soft)
     * 
     * @param string $id
     * 
     * @return mixed
     */
    public function delete($id): mixed
    {
        $this->productService->delete($id);
        return redirect()->back()->with('success', __('product.delete-product-success', ["id" => $id]));
    }

}