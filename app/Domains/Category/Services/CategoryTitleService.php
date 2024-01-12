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
use App\Domains\Category\Models\CategoryTitle;

// Laravel Support
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryTitleService extends Service
{

    public function __construct(CategoryTitle $categoryTitle)
    {
        $this->model = $categoryTitle;
    }

    /**
     * Store new category
     * @param array $data
     * 
     * @return CategoryTitle
     */
    public function store(array $data = []): CategoryTitle
    {
        DB::beginTransaction();

        try{

            $categoryTitle = $this->model->create([
                "title" => $data['title'] ?? null,
                "order" => $data['order'] ?? null,
            ]);

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException($e->getMessage());
        }

        DB::commit();
        return $categoryTitle;
    }

    /**
     * Store new category
     * @param string $id
     * @param array $data
     * 
     * @return CategoryTitle
     */
    public function update(string $id, array $data = []): CategoryTitle
    {
        DB::beginTransaction();

        try{
            $categoryTitle = $this->model->find($id);

            $categoryTitle->update([
                "title" => $data['title'] ?? null,
                "order" => $data['order'] ?? null,
            ]);

        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException($e->getMessage());
        }

        DB::commit();
        return $categoryTitle;
    }

    /**
     * Store new category
     * @param string $id
     * 
     * @return void
     */
    public function delete(string $id): void
    {
        DB::beginTransaction();

        try{
            
            $categories = Category::where('orderId', $id)->get();
            foreach($categories as $category) {
                $category->update([
                    'orderId' => null,
                ]);
            };

            $this->model->find($id)->delete();


        }catch(Exception $e){
            DB::rollBack();
            throw new GeneralException($e->getMessage());
        }

        DB::commit();

    }

}