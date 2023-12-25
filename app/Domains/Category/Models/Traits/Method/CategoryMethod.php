<?php

namespace App\Domains\Category\Models\Traits\Method;

use Illuminate\Support\Facades\Storage;

trait CategoryMethod
{
    /**
     * Return image path
     * 
     * @return string
     */
    public function image(): string
    {
        $files = Storage::disk('public')->files('category');
        $path = '';

        $key = array_search("category/" . $this->name . ".png", $files);
        if($key !== false){
            $path = basename($files[$key]);
        }

        return $path;
    }
}