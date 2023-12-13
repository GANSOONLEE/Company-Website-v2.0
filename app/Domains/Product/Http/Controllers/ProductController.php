<?php

namespace App\Domains\Product\Http\Controllers;

// Request
use App\Domains\Product\Request\CreateProductRequest;

// Service
use App\Domains\Product\Services\ProductService;

// Model
use App\Domains\Product\Models\Product;

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
        return view('backend.admin.product.management');
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

        $product = $this->productService->store($request->validated());
        return redirect()->back()->with('success', __('product.create-product-success'));
    }

}