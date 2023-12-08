<?php

namespace App\Domains\Image\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselImageUploadEvent{

    public function carouselImageUpload(Request $request){

        try{

            // Define variable
            $image = $request->file('image');
            
            // Define disk & directory
            $disk = 'public';
            $directory = 'carousel';

            if(isset($image['general'])){
                $originalName = $image['general']->getClientOriginalName();
                $image['general']->storeAs($directory, $originalName, $disk);
            }

            // Get directory
            $directories = Storage::disk($disk)->allDirectories($directory);

            foreach($directories as $directory){

                if(!isset($image[$directory])){
                    continue;
                }


                $originalName = $image[$directory]->getClientOriginalName();
                $image[$directory]->storeAs($directory, $originalName, $disk);
            }
            

            $status = [
                'status' => 'success',
            ];

        }catch(\Exception $error){
            $status = [
                'status' => 'error',
                'message' => $error->getMessage(),
                'line' => $error->getLine(),
                'file' => $error->getFile(),
            ];
        }

        return redirect()->back();
    }
}