<?php

namespace App\Http\Controllers\Backend\Admin\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselImageController extends Controller
{
    public function carouselImage(){

        $disk = 'public';
        $directory = 'carousel';
        $files = Storage::disk($disk)->files($directory);

        $fileData = [];

        foreach($files as $file){
            $fileContent = new ImageInfo($file);
            $fileData[] = $fileContent;
        }

        return view('backend.admin.image.carousel-image', compact('fileData'));
    }
}

class ImageInfo{
    public $path;
    public $name;
    public $extension;

    public function __construct($path)
    {
        $this->path = 'storage/'.$path;
        $this->name = pathinfo($path, PATHINFO_FILENAME);
        $this->extension = pathinfo($path, PATHINFO_EXTENSION);
    }

    public function getFullName() :string
    {
        $fullName = $this->name . '.' . $this->extension;
        return $fullName;
    }
}