<?php

namespace App\Domains\Image\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselImageUpdateEvent{

    public function carouselImageUpdate(Request $request){

        try{

            // Define variable
            $relationPath = $request->relationPath;
            $fullName = $request->fullName;
            $targetPanel = $request->targetPanel;

            // Define disk & directory
            $disk = 'public';
            $directory = 'carousel';

            // Check are general panel
            if($targetPanel=='general'){
                Storage::disk($disk)->move($relationPath, $directory . '/' . $fullName);
            }else{

                $subdirectories = Storage::disk($disk)->allDirectories($directory);

                foreach ($subdirectories as $subdirectory) {
                    if (basename($subdirectory) !== $targetPanel) {
                        continue;
                    }

                    Storage::disk($disk)->move($relationPath, $subdirectory . '/' . $fullName);
                    
                }
            }

            $status = [
                'status' => 'success',
                'relationPath' => $relationPath,
                'fullName' => $fullName,
                'targetPanel' => $targetPanel,
            ];

        }catch(\Exception $error){
            $status = [
                'status' => 'error',
                'message' => $error->getMessage(),
                'line' => $error->getLine(),
                'file' => $error->getFile(),
            ];
        }
    }
}