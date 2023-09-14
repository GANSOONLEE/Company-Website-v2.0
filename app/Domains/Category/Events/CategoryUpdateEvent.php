<?php

namespace App\Domains\Category\Events;

use Illuminate\Http\Request;

class CategoryUpdateEvent{

    public function categoryUpdate(Request $request){

        // Define variable
        $name = $request->input('category-name');
        $uploadedFile = $request->file('category-cover');

        // Define directory
        $disk = 'public';
        $directory = 'category';

        if ($uploadedFile) {
            $originalName = $uploadedFile->getClientOriginalName();
            $newFileName = $name . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs($directory, $newFileName, $disk);

        }
        
        return redirect()->back();

    }

}