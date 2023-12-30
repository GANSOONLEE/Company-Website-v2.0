<?php

namespace App\Domains\Image\Services;

// Exception
use App\Exceptions\GeneralException;

// Service
use App\Services\BaseService;

// Model
use App\Domains\Image\Models\Image;

// Laravel Support
use Illuminate\Support\Facades\DB;


class ImageService extends BaseService
{

    public function __construct(Image $image)
    {
        $this->model = $image;
    }

    /**
     * Create an image group
     * @param array $data
     * @return
     */
    public function store(array $data = [])
    {

        DB::beginTransaction();

        try {
            $this->model->create([
                'name' => $data['name'],
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException('There was a problem creating the image.');
        }

        DB::commit();

    }

}