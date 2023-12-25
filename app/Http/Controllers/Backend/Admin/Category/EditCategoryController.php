<?php

namespace App\Http\Controllers\Backend\Admin\Category;

use App\Http\Controllers\Controller;
use App\Domains\Category\Models\Category;
use Illuminate\Support\Facades\Storage;

class EditCategoryController extends Controller
{
    public function editCategory(){

        // check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_category'))){
            abort(403, 'Insufficient permissions');
        };

        $disk = 'public';
        $directory = 'category';
        $files = Storage::disk($disk)->files($directory);

        // Array
        $categoryData = [];
        $categories = Category::all();

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
                'entity' => $category,
                'cover' => $cover,
            ];

            $categoryData[] = $categoryCover;
        }

        return view('backend.admin.category.edit-category', compact('categoryData'));
    }
}
