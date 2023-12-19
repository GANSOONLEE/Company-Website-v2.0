<?php

namespace App\Domains\Category\Services;

// Base
use App\Services\BaseService as Service;

// Event
use App\Domains\Category\Events\CategoryCreated;
use App\Domains\Category\Events\CategoryUpdated;
use App\Domains\Category\Events\CategoryDeleted;

// Exceptions
use Exception;
use App\Exceptions\GeneralException;

// Model
use App\Domains\Category\Models\Category;

// Laravel Support
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryService extends Service
{

    protected string $disk = "public";
    protected string $directory = 'category';

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Store new category
     * @param array $data
     * 
     * @return Category
     */
    public function store(array $data = []): Category
    {
        DB::beginTransaction();

        try{

            // Save category data
            $category = $this->createCategory([
                'name' => $data['name']
            ]);

            if($data['image']){
                $newFileName = $category->name . '.' . $data['image']->getClientOriginalExtension();

                // Save category image
                $data['image']->storeAs($this->directory, $newFileName, $this->disk);
            }

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException('Them have problem to creating category.');
        }

        event(new CategoryCreated($category));

        DB::commit();
        return $category;
    }

    /**
     * Patch product data
     * @param array $data
     * 
     * @return Category
     */
    public function update(string $id, array $data = []): Category
    {
        DB::beginTransaction();

        $category = Category::find($id);

        try{

            if($data['name'] && $data['name'] !== $category->name){
                
                if(isset($data['image'])){
                    $extension = $data['image']->getClientOriginalExtension();
                    $data['image']->storeAs($this->directory, $data['name'] . ".$extension", $this->disk);
                }else{
                    $from = "category/" . $category->image();
                    $to = "category/" . $data['name'] . '.' . explode('.', $category->image())[1];

                    Storage::disk('public')->move($from, $to);
                }
                    
                $products = \App\Domains\Product\Models\Product::where('product_category', $category->name)->get();
                foreach($products as $product)
                {
                    $product->update([
                        'product_category' => $data['name'],
                    ]);
                }


            }else{
                if(isset($data['image'])){
                    $extension = $data['image']->getClientOriginalExtension();
                    $data['image']->storeAs($this->directory, $category->name . ".$extension", $this->disk);
                }
            }

            $category->update([
                'name' => $data['name'],
            ]);

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage(), $e->getLine());
            throw new GeneralException('Them have problem to updating category, please try again.');
        }
        
        DB::commit();
        return $category;
    }

    /**
     * Destroy category
     * @param string $id
     * 
     * @return mixed
     */
    public function destroy(string $id): mixed
    {
        $category = Category::find($id);

        if($category->products()->count() > 0){
            throw new GeneralException('You can\'t delete category with more than one product');
        }

        $category->delete();
        event(new CategoryDeleted($category));
        return $category;
    }

    /**
     * Create new category
     * @param array $data
     * 
     * @return Category
     */
    public function createCategory(array $data = []): Category
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }

}