<?php

namespace App\Domains\Image\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselImageDeleteEvent{

    public function carouselImageDelete(Request $request){

        try{

            // Define variable
            $relationPath = $request->relationPath;
            $sourcePanel = $request->sourcePanel;

            // Define disk & directory
            $disk = 'public';
            $directory = 'carousel';

            // Check are general panel
            $debug = Storage::disk($disk)->delete($relationPath);
            $path = $directory . '/' . $relationPath;

            $status = [
                'status' => 'success',
                'debug' => $debug,
                'path' => $path
            ];

        }catch(\Exception $error){
            $status = [
                'status' => 'error',
                'message' => $error->getMessage(),
                'line' => $error->getLine(),
                'file' => $error->getFile(),
            ];
        }

        return response()->json($status);
    }
}