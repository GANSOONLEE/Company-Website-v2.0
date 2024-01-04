<?php

namespace App\Domains\Brand\Events;

use App\Domains\Brand\Models\Brand;
use Illuminate\Queue\SerializesModels;
use App\Events\BaseEvent;

class BrandCreated extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $brand;
    
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
        $this->createOperation('create', 'brand', $brand->name);
    }
}