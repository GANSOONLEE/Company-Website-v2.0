<?php

namespace App\Domains\Category\Events;

use App\Models\Category;
use App\Models\Operation;
use Illuminate\Http\Request;

class CategoryCreateEvent{

    public function categoryCreate(Request $request){

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

        // Create record at DB
        $data = ['name' => $name];
        Category::create($data);

        $operation = [
            'email' => auth()->user()->email,
            'operation_type' => 'Create',
            'operation_category' => 'Category',
        ];

        Operation::create($operation);
        
        return redirect()->back();

    }

}