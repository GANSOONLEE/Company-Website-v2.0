<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller{

    public function category(){

        $categoryData = Category::all();

        $disk = 'public';
        $directory = 'category';
        $files = Storage::disk($disk)->files($directory);
        $categoryCover = array_filter($files, function ($file) {
            return $file;
        });

        return view('frontend.category', compact('categoryData', 'categoryCover'));

    }
    
}
