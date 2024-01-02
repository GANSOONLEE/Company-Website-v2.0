<?php

namespace App\Domains\Image\Http\Controllers;

// Model
use App\Domains\Image\Models\Image;

// Service
use App\Domains\Image\Services\ImageService;

// Request
use App\Domains\Image\Request\CreateImageRequest;
use App\Domains\Image\Request\UpdateImageRequest;

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
     * Get [View] for edit
     * url: admin/image/edit/{id}
     * method: GET
     * route: backend.admin.image.edit
     * 
     * @param string $id
     * @return mixed
     */
    public function edit(string $id): mixed
    {
        $image = Image::find($id);
        return view('backend.admin.image.edit', compact('image'));
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
     * 
     */
    public function upload()
    {

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

    /**
     * Patch Image Name
     * url:
     * method: PATCH
     * route
     * 
     * @param string $id
     * 
     */
    public function update(UpdateImageRequest $request, string $id)
    {
        $this->imageService->update($request->validated(), $id);
        return redirect()->back()->with('success', trans('image.update-image-successful'));
    }

    /**
     * Destroy media
     * @param string $id
     */
    public function destroy(string $id)
    {
        $this->imageService->destroy($id);
        return redirect()->back()->with('success', trans('image.destroy-image-successful'));
    }
}