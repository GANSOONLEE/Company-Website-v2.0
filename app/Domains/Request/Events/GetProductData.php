<?php

namespace App\Domains\Request\Events;

use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GetProductData {

    public $parameter;

    public function getProductData(Request $request){

        try {
            $this->parameter = $request->parameter;

            $defaultOptions = [
                "sort" => [
                    "sort_by_category" => false,
                    "sort_by_type" => false,
                ],
                "return_data" => [
                    "product_code",
                    "product_category",
                    "product_type",
                ],
                "analysis" => [
                    "total_record" => false,
                    "count_with_category" => false,
                    "count_with_type" => false,
                ],
            ];

            $options = isset($this->parameter) ?
                array_merge($defaultOptions, $this->parameter)
                : $defaultOptions;

        
            return $this->buildRequestQuery($options);

        } catch (\Exception $e) {

            $error = [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
            ];

            return response()->json($error);
        }

    }

    public function buildRequestQuery($options){

        try {
            $query = Product::query();
            $total = 'Not set';
            $category_count = 'Not set';
            $type_count = 'Not set';

            if($options["sort"]["sort_by_category"] == true){
                $query->orderBy('product_category', 'asc');
            }

            if($options["sort"]["sort_by_category"] == true){
                $query->orderBy('product_type', 'asc');
            }

            $query->select($options["return_data"]);

            if($options["analysis"]["total_record"] == "true"){
                $total = $query->count();
            }
            
            if($options["analysis"]["count_with_category"] == "true"){
                $category_count = $query->groupBy('product_category')
                    ->select('product_category', DB::raw('count(*) as count'))
                    ->get();
            }

            if($options["analysis"]["count_with_type"] == "true"){
                $type_count = $query->groupBy('product_type')
                    ->select('product_type', DB::raw('count(*) as count'))
                    ->get();
            }

            $count = [
                "total" => $total,
                "category_count" => $category_count,
                "type_count" => $type_count,
            ];

            $result = $query->get();

            $response = [
                "result" => $result,
                "count" => $count,
                'options' => $options,
            ];

            return response()->json($response);

        } catch (\Exception $e) {

            $error = [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
            ];

            return response()->json($error);
        }
    }

}

