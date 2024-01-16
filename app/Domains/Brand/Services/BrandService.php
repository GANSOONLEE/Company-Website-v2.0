<?php

namespace App\Domains\Brand\Services;

// Base
use App\Services\BaseService as Service;

// Event
use App\Domains\Brand\Events\BrandCreated;
use App\Domains\Brand\Events\BrandUpdated;
use App\Domains\Brand\Events\BrandDeleted;

// Exceptions
use Exception;
use App\Exceptions\GeneralException;

// Model
use App\Domains\Brand\Models\Brand;

// Laravel Support
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandService extends Service
{

    protected string $disk = "public";
    protected string $directory = 'brand';

    public function __construct(Brand $brand)
    {
        $this->model = $brand;
    }

    /**
     * Store new brand
     * @param array $data
     * 
     * @return Brand
     */
    public function store(array $data = []): Brand
    {
        DB::beginTransaction();

        try{

            // Save brand data
            $brand = $this->createBrand([
                'name' => $data['name']
            ]);

            if(isset($data['image'])){
                $newFileName = $brand->name . '.' . $data['image']->getClientOriginalExtension();

                // Save brand image
                $data['image']->storeAs($this->directory, $newFileName, $this->disk);
            }

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException('Them have problem to creating brand.');
        }

        event(new BrandCreated($brand));

        DB::commit();
        return $brand;
    }

    /**
     * Patch brand data
     * @param array $data
     * 
     * @return Brand
     */
    public function update(string $id, array $data = []): Brand
    {
        DB::beginTransaction();

        $brand = Brand::find($id);

        try{

            if($data['name'] && $data['name'] !== $brand->name){
                
                if(isset($data['image'])){
                    $extension = $data['image']->getClientOriginalExtension();
                    $data['image']->storeAs($this->directory, $data['name'] . ".$extension", $this->disk);
                }else{
                    if($brand->image() != ''){
                        $from = "brand/" . $brand->image();
                        $to = "brand/" . $data['name'] . '.' . explode('.', $brand->image())[1];
    
                        Storage::disk('public')->move($from, $to);
                    }
                }
                    
                $brand = Brand::where('id', $id)->first();
            
                $products = DB::table('products_brand')
                    ->where('brand', $brand->name)
                    ->get();
    
                foreach ($products as $product){
                    DB::table('products_brand')
                        ->where('id', $product->id)
                        ->update([
                            'brand' => $data['name']
                        ]);
                }



            }else{
                if(isset($data['image'])){
                    $extension = $data['image']->getClientOriginalExtension();
                    $data['image']->storeAs($this->directory, $brand->name . ".$extension", $this->disk);
                }
            }

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage(), $e->getLine());
            throw new GeneralException('Them have problem to updating brand, please try again.');
        }
        
        $brand->update([
            'name' => $data['name'],
        ]);
        
        DB::commit();

        return $brand;
    }

    /**
     * Destroy brand
     * @param string $id
     * 
     * @return mixed
     */
    public function destroy(string $id): mixed
    {
        $brand = Brand::find($id);

        if($brand->products()->count() > 0){
            throw new GeneralException('You can\'t delete brand with more than one product');
        }

        $brand->delete();
        event(new BrandDeleted($brand));
        return $brand;
    }

    /**
     * Create new brand
     * @param array $data
     * 
     * @return Brand
     */
    public function createBrand(array $data = []): Brand
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }

}