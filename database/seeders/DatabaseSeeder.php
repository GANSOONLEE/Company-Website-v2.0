<?php

namespace Database\Seeders\Domains\Auth\Models;

use App\Domains\Product\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $mode = 'create faker data'; // "create faker data", "clear faker data"

        if(config('app.env') === 'production'){
            print('Only can use in local mode!');
            return false;
        }

        switch ($mode){

            case 'create faker data':
                $faker = Faker::create();
                $number = 0;
                foreach (range(1, 100) as $index) {
                    $productCode = $faker->numberBetween(100000000000, 999999999999);
                    DB::table('products')->insert([
                        'product_code' => $productCode,
                        'product_category' => DB::table('categories')->inRandomOrder()->first()->name,
                        'product_status' => 'Public',
                        'faker' => true,
                    ]);
                    DB::table('products_brand')->insert([
                        'sku_id' => $faker->unique()->randomNumber(8),
                        'brand' =>  DB::table('brands')->inRandomOrder()->first()->name,
                        'code' => $faker->unique()->randomNumber(5),
                        'frozen_code' => 'FZ-' . $faker->unique()->numberBetween(10000, 99999),
                        'product_code' => $productCode,
                    ]);
                    DB::table('products_name')->insert([
                        'name' => $faker->word,
                        'product_code' => $productCode,
                    ]);
                    $number++;
                }
                print("Successful create faker record, total $number");
                break;
            
            case 'clear faker data':
                $fakeProduct = Product::where('faker', true)->get();
                $number = Product::where('faker', true)->count();
                foreach ($fakeProduct as $product)
                {
                    $product->deleteWithRelatedRecords();
                }
                print("Successful delete faker record, total $number");
                break;

            default:
                print('Please choose a mode');
                break;

        }
    }
}
