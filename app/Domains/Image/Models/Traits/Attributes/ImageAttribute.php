<?php

namespace App\Domains\Image\Models\Traits\Attributes;

// Laravel Support
use Illuminate\Support\Facades\Storage;

trait ImageAttribute
{

    /**
     * Find the count of images for this media
     * @return int
     */
    public function mediaCount(): int
    {
        $files = Storage::disk("public")->allFiles("carousel/$this->name");
        return count($files);
    }

}