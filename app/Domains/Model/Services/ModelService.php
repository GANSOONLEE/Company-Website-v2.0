<?php

namespace App\Domains\Model\Services;

use App\Services\BaseService;
use App\Models\CarModel as Model;
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

    public function createModel(array $data): Model
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }

}