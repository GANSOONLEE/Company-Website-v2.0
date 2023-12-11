<?php

namespace App\Domains\Product\Http\Controllers;

// Request

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

}