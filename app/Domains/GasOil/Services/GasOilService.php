<?php

namespace App\Domains\GasOil\Services;

// Service
use App\Services\BaseService;

// Model
use App\Domains\GasOil\Models\GasOil;

// Exception
use App\Exceptions\GeneralException;

// Laravel Support
use Exception;
use Illuminate\Support\Facades\DB;

class GasOilService extends BaseService
{

    public function __construct(GasOil $gasOil)
    {
        $this->model = $gasOil;
    }

    /**
     * Store the GasOil data
     * @param array $data
     * 
     * @return GasOil
     */
    public function store(array $data = [])
    {

        DB::beginTransaction();

        try {

            $gasOil = $this->model->create([
                'model_name' => '',
                'model_serial_name' => '',
                'gas' => '',
                'oil' => '',
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException('Then was a problem storing the data.');
        }

        DB::commit();
        return $gasOil;
    }

    /**
     * Update the GasOil data
     * @param array $data
     * 
     * @return GasOil
     */
    public function update(array $data = [])
    {
        DB::beginTransaction();

        try {

            $gasOil = $this->model->find($data['id']);

            $gasOil->update([
                'model_name' => $data['model_name'] ?? $gasOil->model_name,
                'model_serial_name' => $data['model_serial_name'] ?? $gasOil->model_serial_name,
                'gas' => $data['gas'] ?? $gasOil->gas,
                'oil' => $data['oil'] ?? $gasOil->oil,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException('Then was a problem updating the data.');
        }

        DB::commit();
        return $gasOil;
    }

    /**
     * Destroy the GasOil data
     * @param array $data
     * 
     * @return void
     */
    public function destroy(string $id)
    {
        $this->model->find($id)->delete();
    }

}