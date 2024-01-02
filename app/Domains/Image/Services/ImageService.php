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
use Illuminate\Support\Facades\Storage;


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

        $name = str_replace(' ', '_', strtolower($data['name']));

        try {
            $this->model->create([
                'name' => $name,
            ]);
            Storage::disk('public')->makeDirectory("carousel/$name");
        }catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException('There was a problem creating the image.');
        }

        DB::commit();

    }

    /**
     * 
     */
    public function update(array $data, string $id)
    {
        $image = Image::find($id);
        DB::beginTransaction();

        try{

            // Update Directory name
            $files = Storage::disk('public')->allFiles("carousel/$image->name");
            Storage::disk('public')->makeDirectory("carousel/" . $data['name']);
            foreach ($files as $file) {
                $name = basename($file);
                Storage::disk('public')->move("carousel/$image->name/$name", "carousel/" . $data['name'] . "/$name");
            }
            Storage::disk('public')->deleteDirectory("carousel/$image->name");

            // Update image name
            $image->update([
                'name' => $data['name']
            ]);


        }catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException('There was a problem updating the image.');
        }

        DB::commit();
    }

    /**
     * Destroy media
     * @param string $id
     */
    public function destroy(string $id)
    {
        $media = $this->model->find($id);
        
        DB::beginTransaction();

        try{
            // Delete record
            $media->delete();

            // Destroy File Directory
            Storage::disk('public')->deleteDirectory("carousel/$media->name");

        }catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException('There was a problem deleting the image.');
        };

        DB::commit();
    }

}