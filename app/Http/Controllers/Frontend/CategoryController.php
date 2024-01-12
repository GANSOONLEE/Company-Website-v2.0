<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Domains\Category\Models\Category;
use App\Domains\Category\Models\CategoryTitle;

use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller{

    public function category()
    {

        $disk = 'public';
        $directory = 'category';
        $files = Storage::disk($disk)->files($directory);

        // Array
        $categoryData = [];
        $categoryTitle = [];
        $categories = Category::orderBy('name')->get();

        foreach ($categories as $index => $category) {

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
            
            $categoryCover = (object)[
                'name' => $category->name,
                'cover' => $cover,
            ];

            $categoryTitle[$category->title()->title ?? 'Unassign'][] = $categoryCover;
        };

        uksort($categoryTitle, function ($a, $b) {
            return intval(CategoryTitle::where('title', $a)->value('order')) <=> intval(CategoryTitle::where('title', $b)->value('order'));
        });

        unset($data);

        return view('frontend.category', compact('categoryTitle'));

    }
    
}
