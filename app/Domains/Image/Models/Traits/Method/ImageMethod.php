<?php

namespace App\Domains\Image\Models\Traits\Method;

// Laravel Support
use Illuminate\Support\Facades\Storage;

trait ImageMethod
{

    /**
     * Find the count of images for this media
     * @return array
     */
    public function getImages(): array
    {
        return Storage::disk("public")->allFiles("carousel/$this->name");
    }

}