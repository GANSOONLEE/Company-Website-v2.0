<?php

namespace App\Domains\Category\Http\Controllers;

// Request
use App\Domains\Category\Request\CreateCategoryTitleRequest;
use App\Domains\Category\Request\UpdateCategoryTitleRequest;
use App\Domains\Category\Request\DeleteCategoryRequest;

// Service
use App\Domains\Category\Services\CategoryTitleService;

// Laravel Support

class categoryTitleController
{

    public $categoryTitleService;

    public function __construct(CategoryTitleService $categoryTitleService)
    {
        $this->categoryTitleService = $categoryTitleService;
    }

    /**
     * Create a new category title
     * 
     * @param CreateCategoryTitleRequest $request
     * 
     * @return mixed
     */
    public function store(CreateCategoryTitleRequest $request): mixed
    {
        $this->categoryTitleService->store($request->validated());
        return redirect()->back()->with('success', 'Category title created successfully!');
    }

    /**
     * Create a new category title
     * 
     * @param string $id
     * @param UpdateCategoryTitleRequest $request
     * 
     * @return mixed
     */
    public function update(string $id, UpdateCategoryTitleRequest $request): mixed
    {
        $this->categoryTitleService->update($id, $request->validated());
        return redirect()->back()->with('success', 'Category title update successfully!');
    }

    /**
     * Create a new category title
     * 
     * @param string $id
     * 
     * @return mixed
     */
    public function delete(string $id): mixed
    {
        $this->categoryTitleService->delete($id);
        return redirect()->back()->with('success', 'Category title delete successfully!');
    }
}