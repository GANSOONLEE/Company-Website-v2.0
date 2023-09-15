<?php

namespace App\Domains\Brand\Events;

use Illuminate\Http\Request;

class BrandUpdateEvent{

    public function brandUpdate(Request $request){

        // Define variable
        $name = $request->input('brand-name');
        $uploadedFile = $request->file('brand-cover');

        // Define directory
        $disk = 'public';
        $directory = 'brand';

        if ($uploadedFile) {
            $originalName = $uploadedFile->getClientOriginalName();
            $newFileName = $name . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs($directory, $newFileName, $disk);

        }
        
        return redirect()->back();

    }

}