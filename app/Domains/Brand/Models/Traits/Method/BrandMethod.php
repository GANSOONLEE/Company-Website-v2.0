<?php

namespace App\Domains\Brand\Models\Traits\Method;

use Illuminate\Support\Facades\Storage;

trait BrandMethod
{
    /**
     * Return image path
     * 
     * @return string
     */
    public function image(): string
    {
        $files = Storage::disk('public')->files('brand');
        $path = '';

        $key = array_search("brand/" . $this->name . ".png", $files);
        if($key !== false){
            $path = basename($files[$key]);
        }

        return $path;
    }
}