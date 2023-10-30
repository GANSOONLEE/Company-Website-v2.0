<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DeleteProductImageEvent{

    public function deleteImage(Request $request){

        try{

            $imageSrc = $request->src;

            $response = Http::delete($imageSrc);

            $status = [
                "result" => "success",
                "imageSrc" => $imageSrc,
                'response' => $response->successful()
            ];
        }catch(\Exception $e){
            $status = [
                "result" => "failure",
                "file" => $e->getFile(),
                "line" => $e->getLine(),
                "message" => $e->getMessage()
            ];
        }

        return response()->json($status);

    }

}