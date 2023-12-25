<?php

namespace App\Domains\Category\Http\Controllers;

// Request
use App\Domains\Category\Request\CreateCategoryRequest;
use App\Domains\Category\Request\UpdateCategoryRequest;
use App\Domains\Category\Request\DeleteCategoryRequest;

// Service
use App\Domains\Category\Services\CategoryService;

// Laravel Support

class CategoryController
{

    /**
     * @var CategoryService $categoryService
     */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Get the category create view
     * @return mixed
     */
    public function create(): mixed
    {
        return view('backend.admin.category.create');
    }

    /**
     * Post the Category data to create it
     * @param CreateCategoryRequest $request
     * 
     * @return mixed
     */
    public function store(CreateCategoryRequest $request): mixed
    {
        $category = $this->categoryService->store($request->validated());
        return redirect()->back()->with('success', __('category.create-category-success', ["category" => $category->name]));
    }

    /**
     * Get the category edit view
     * @return mixed
     */
    public function edit(): mixed
    {
        return view('backend.admin.category.edit');
    }

    /**
     * Patch the category data
     * @param string $id
     * @param UpdateCategoryRequest $request
     * 
     * @return mixed
     */
    public function update(string $id, UpdateCategoryRequest $request): mixed
    {
        $category = $this->categoryService->update($id, $request->validated());
        return redirect()->back()->with('success', __('category.update-category-success', ["category" => $category->name]));
    }

    /**
     * Delete the category
     * @param string $id
     * 
     * @return mixed
     */
    public function destroy(string $id): mixed
    {
        $category = $this->categoryService->destroy($id);
        return redirect()->back()->with('success', __('category.delete-category-success', ["category" => $category->name]));
    }

}