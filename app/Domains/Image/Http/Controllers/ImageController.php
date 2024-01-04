<?php

namespace App\Domains\Image\Http\Controllers;

// Model
use App\Domains\Image\Models\Image;

// Service
use App\Domains\Image\Services\ImageService;

// Request
use App\Domains\Image\Request\CreateImageRequest;
use App\Domains\Image\Request\UpdateImageRequest;
use App\Domains\Image\Request\UploadImageRequest;

// Laravel Support
use Illuminate\Http\Request;

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
        $imageInstance = Image::find($id);
        return view('backend.admin.image.edit', compact('imageInstance'));
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
    public function upload(UploadImageRequest $request, string $id): mixed
    {
       $this->imageService->upload($request->validated(), $id);
       return redirect()->back()->with('success', trans('image.upload-image-successful'));
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
     * Get [View] for management
     * url: admin/image/permission
     * method: GET
     * route: backend.admin.image.permission
     * 
     * @return mixed
     */
    public function permission(): mixed
    {
        return view('backend.admin.image.permission');
    }

    /**
     * Patch Image Name
     * url: admin/image/{id}
     * method: PATCH
     * route: backend.admin.image.update
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
     * Delete Image
     * @param string $id
     */
    public function destroyImage(Request $request, $id)
    {
        $this->imageService->delete($request->all(), $id);
        return redirect()->back()->with('success', trans('image.delete-image-successful'));
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