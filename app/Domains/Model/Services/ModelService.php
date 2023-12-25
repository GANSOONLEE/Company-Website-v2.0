<?php

namespace App\Domains\Model\Services;

use App\Services\BaseService;
use App\Domains\Model\Models\Model as Model;
use App\Exceptions\GeneralException;

use Illuminate\Support\Facades\DB;

class ModelService extends BaseService
{

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function registerModel(array $data = []): Model
    {
        DB::beginTransaction();

        try{
            $model = $this->createModel($data);
        } catch (\Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating the model'));
        }

        return $model;
    }

    /**
     * @param  array  $data
     *
     * @return Model
     * @throws GeneralException
     * @throws \Throwable
     */

    public function store(array $data = []): Model
    {
        DB::beginTransaction();

        try{
            $model = $this->createModel([
                'name' => $data["name"],
            ]);

        }catch (\Exception $e){

            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this model. Please try again'));
        }

        DB::commit();

        return $model;
    }

    /**
     * Update model
     * @param string $id
     * @param array $data
     * 
     * @return Model
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(string $id, array $data =  []): Model
    {
        DB::beginTransaction();

        try{
            $model = Model::where('id', $id)->first();
            
            $products = DB::table('products_name')
                ->where('name', 'LIKE', "%$model->name%")
                ->get();

            foreach ($products as $product){
                DB::table('products_name')
                    ->where('id', $product->id)
                    ->update(['name' => str_replace($model->name, $data['name'], $product->name)]);
            }

            $model->update([
                'name' => $data['name']
            ]);


        }catch(\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
        }

        DB::commit();
        return $model;
    }

    public function createModel(array $data): Model
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }

}