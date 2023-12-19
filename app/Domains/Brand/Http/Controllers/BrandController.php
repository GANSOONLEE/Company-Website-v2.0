<?php

namespace App\Domains\Brand\Http\Controllers;

// Request
use App\Domains\Brand\Request\CreateBrandRequest;
use App\Domains\Brand\Request\UpdateBrandRequest;

// Service
use App\Domains\Brand\Services\BrandService;

// Laravel Support

class BrandController
{

    /**
     * @var BrandService $brandService
     */
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Get the brand create view
     * @return mixed
     */
    public function create(): mixed
    {
        return view('backend.admin.brand.create');
    }

    /**
     * Post the Brand data to create it
     * @param CreateBrandRequest $request
     * 
     * @return mixed
     */
    public function store(CreateBrandRequest $request): mixed
    {
        $brand = $this->brandService->store($request->validated());
        return redirect()->back()->with('success', __('brand.create-brand-success', ["brand" => $brand->name]));
    }

    /**
     * Get the brand edit view
     * @return mixed
     */
    public function edit(): mixed
    {
        return view('backend.admin.brand.edit');
    }

    /**
     * Patch the brand data
     * @param string $id
     * @param UpdateBrandRequest $request
     * 
     * @return mixed
     */
    public function update(string $id, UpdateBrandRequest $request): mixed
    {
        $brand = $this->brandService->update($id, $request->validated());
        return redirect()->back()->with('success', __('brand.update-brand-success', ["brand" => $brand->name]));
    }

    /**
     * Delete the brand
     * @param string $id
     * 
     * @return mixed
     */
    public function destroy(string $id): mixed
    {
        $brand = $this->brandService->destroy($id);
        return redirect()->back()->with('success', __('brand.delete-brand-success', ["brand" => $brand->name]));
    }

}