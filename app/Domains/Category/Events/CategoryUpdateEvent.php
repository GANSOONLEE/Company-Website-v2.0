<?php

namespace App\Domains\Category\Events;

use App\Domains\Category\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryUpdateEvent{

    public function categoryUpdate(Request $request){

        try{
            // Define variable
            $name = $request->input('category-name');
            $nameOld = $request->input('category-name-old');
            $uploadedFile = $request->file('category-cover');
    
            // Define directory
            $disk = 'public';
            $directory = 'category';

            if($name != $nameOld){
                $record = Category::where('name', $nameOld)->first();
                $record->update([
                    'name' => $name,
                ]);

                $files = Storage::files($directory);

                foreach ($files as $file) {
                    Storage::move($file, "$name" . $file->getClientOriginalExtension());
                }
            }
    
            if ($uploadedFile) {
                $originalName = $uploadedFile->getClientOriginalName();
                $newFileName = $name . '.' . $uploadedFile->getClientOriginalExtension();
                $path = $uploadedFile->storeAs($directory, $newFileName, $disk);
    
            }

            $status = [
                'status' => trans('category.update-success'),
                'icon' => 'success',
            ];

        }catch(\Exception $e){

            $status = [
                'status' => trans('category.update-failure'),
                'icon' => 'error',
            ];
        }

        
        return response()->json($status);
    }

}