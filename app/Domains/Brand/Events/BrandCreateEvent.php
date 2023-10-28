<?php

namespace App\Domains\Brand\Events;

use App\Models\Brand;
use App\Models\Operation;
use Illuminate\Http\Request;

class BrandCreateEvent{

    public function brandCreate(Request $request){

        // Define variable
        $name = $request->input('brand-name');
        $uploadedFile = $request->file('brand-cover');

        // Define directory
        $disk = 'public';
        $directory = 'brand';

        // Check Image Existent
        if ($uploadedFile) {
            $originalName = $uploadedFile->getClientOriginalName();
            $newFileName = $name . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs($directory, $newFileName, $disk);
        }

        // Create record at DB
        $data = ['name' => $name];
        Brand::create($data);

        $operation = [
            'email' => auth()->user()->email,
            'operation_type' => 'Create',
            'operation_category' => 'Brand',
        ];

        Operation::create($operation);
        
        return redirect()->back();

    }

}