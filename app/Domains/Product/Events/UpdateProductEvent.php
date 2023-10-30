<?php

namespace App\Domains\Product\Events;
use App\Models\Product;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateProductEvent{

    public function updateProduct(Request $request){

        dd($request->all());

    }

}