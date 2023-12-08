<?php

namespace App\Http\Controllers\Backend\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class EditBrandController extends Controller
{
    public function editBrand(){

        // check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_brand'))){
            abort(403, 'Insufficient permissions');
        };

        $disk = 'public';
        $directory = 'brand';
        $files = Storage::disk($disk)->files($directory);

        // Array
        $brandData = [];
        $brands = Brand::orderBy('name', 'asc')
                    ->get();

        foreach ($brands as $brand) {
            $matchingFile = null;
            
            foreach ($files as $file) {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                if ($brand->name === $fileName) {
                    $matchingFile = 'storage/' . $file;
                    break;
                }
            }

            if ($matchingFile !== null) {
                $cover = $matchingFile;
            } else {
                $cover = 'storage/brand/placeholder.svg';
            }
            
            $brandCover = [
                'entity' => $brand,
                'cover' => $cover,
            ];

            $brandData[] = $brandCover;
        }

        return view('backend.admin.brand.edit-brand', compact('brandData'));
    }
}
