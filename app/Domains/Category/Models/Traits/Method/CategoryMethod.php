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
        $key = null;

        foreach ($files as $file) {
            if(strpos(basename($file), $this->name) === 0) {
                $key = $file;
                break;
            };
        }
        if($key !== null){
            $path = basename($key);
        }

        return $path;
    }
}