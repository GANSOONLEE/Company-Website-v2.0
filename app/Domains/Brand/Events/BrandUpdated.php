<?php

namespace App\Domains\Brand\Events;

use App\Domains\Brand\Models\Brand;
use Illuminate\Queue\SerializesModels;

class BrandUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $brand;
    
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
}