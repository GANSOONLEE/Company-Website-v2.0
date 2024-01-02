<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Domains\Category\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller{

    public function category()
    {

        $disk = 'public';
        $directory = 'category';
        $files = Storage::disk($disk)->files($directory);

        // Array
        $categoryData = [];
        $categories = Category::orderBy('name')->get();

        foreach ($categories as $category) {
            $matchingFile = null;
            
            foreach ($files as $file) {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                if ($category->name === $fileName) {
                    $matchingFile = 'storage/' . $file;
                    break;
                }
            }

            if ($matchingFile !== null) {
                $cover = $matchingFile;
            } else {
                $cover = 'storage/category/placeholder.png';
            }
            
            $categoryCover = [
                'name' => $category->name,
                'cover' => $cover,
            ];

            $categoryData[] = $categoryCover;
        }

        return view('frontend.category', compact('categoryData'));

    }
    
}
