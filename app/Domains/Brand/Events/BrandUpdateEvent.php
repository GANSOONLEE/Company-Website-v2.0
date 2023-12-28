<?php

namespace App\Domains\Brand\Events;

use App\Domains\Brand\Models\Brand;
use App\Domains\Data\Models\Operation;
use Illuminate\Http\Request;

class BrandUpdateEvent{

    public function brandUpdate(Request $request){

        // Define variable
        $name = $request->input('brand-name');
        $originName = $request->input('brand-origin-name');
        $uploadedFile = $request->file('brand-cover');

        // Define directory
        $disk = 'public';
        $directory = 'brand';

        if ($uploadedFile) {
            $originalName = $uploadedFile->getClientOriginalName();
            $newFileName = $name . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs($directory, $newFileName, $disk);
        }

        $brand = Brand::where('name', $originName)->first();
        $brand->update([
            "name" => $name,
        ]);

        $operation = [
            'email' => auth()->user()->email,
            'operation_type' => 'Update',
            'operation_category' => 'Brand',
        ];

        Operation::create($operation);
        
        return redirect()->back();

    }

}