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
        $subdirectories = Storage::disk($disk)->allDirectories($directory);

        $fileData = [];
        $panelData = [];

        foreach($files as $file){
            $fileContent = new ImageInfo($file);
            $fileData[] = $fileContent;
        }

        foreach ($subdirectories as $subdirectory) {
            $panelSection = [];
            $panelImages = [];

            $panelName = pathinfo($subdirectory, PATHINFO_FILENAME);
            $panelFiles = Storage::disk($disk)->files($subdirectory);

            foreach($panelFiles as $panelFile){
                $panelImages[] = new ImageInfo($panelFile);
            };

            $panelSection = [
                'panelName' => $panelName,
                'panelImage' => $panelImages,
            ];

            $panelData[] = $panelSection;
        }

        return view('backend.admin.image.carousel-image', compact('fileData', 'panelData'));
    }
}

class ImageInfo{

    public $rawPath;

    public $path;

    public $name;

    public $extension;

    public $panel;

    public function __construct($path)
    {
        $this->rawPath = $path;
        $this->path = 'storage/'.$path;
        $this->name = pathinfo($path, PATHINFO_FILENAME);
        $this->extension = pathinfo($path, PATHINFO_EXTENSION);
    }

    public function getFullName() :string
    {
        $fullName = $this->name . '.' . $this->extension;
        return $fullName;
    }

    public function relativePath() :string
    {
        return $this->rawPath;
    }
}