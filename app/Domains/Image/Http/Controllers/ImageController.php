<?php

namespace App\Domains\Image\Http\Controllers;

// Service
use App\Domains\Image\Services\ImageService;

// Request
use App\Domains\Image\Request\CreateImageRequest;

// Laravel Support


class ImageController
{
    /**
     * @var
     */
    protected $imageService;
    
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Get [View] for index
     * url: admin/image/
     * method: GET
     * route: backend.admin.image.index
     * 
     * @return mixed
     */
    public function index(): mixed
    {
        return view('backend.admin.image.index');
    }

    /**
     * Get [View] for create
     * url: admin/image/create
     * method: GET
     * route: backend.admin.image.create
     * 
     * @return mixed
     */
    public function create(): mixed
    {
        return view('backend.admin.image.create');
    }

    /**
     * Get [View] for store
     * url: admin/image/
     * method: POST
     * route: backend.admin.image.store
     * @param CreateImageRequest $request
     * @return mixed
     */
    public function store(CreateImageRequest $request): mixed
    {
        $this->imageService->store($request->validated());
        return redirect()->back()->with('success', trans('image.create-image-successful'));
    }

    /**
     * Get [View] for management
     * url: admin/image/management
     * method: GET
     * route: backend.admin.image.management
     * 
     * @return mixed
     */
    public function management(): mixed
    {
        return view('backend.admin.image.management');
    }
}