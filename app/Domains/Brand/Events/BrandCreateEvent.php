<?php

namespace App\Domains\Brand\Events;

use App\Domains\Brand\Models\Brand;
use App\Domains\Data\Models\Operation;
use Illuminate\Http\Request;

class BrandCreateEvent{

    public function brandCreate(Request $request){

        try{
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

            $status = [
                'status' => trans('brand.upload-success'),
                'icon' => 'success',
            ];
        }catch(\Exception $e){

            $status = [
                'status' => trans('brand.upload-failure'),
                'icon' => 'error'
            ];
        }
        
        return response()->json($status);

    }

}