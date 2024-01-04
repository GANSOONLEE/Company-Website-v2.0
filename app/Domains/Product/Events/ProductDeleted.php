<?php

namespace App\Domains\Product\Events;

use App\Domains\Product\Models\Product;
use Illuminate\Queue\SerializesModels;
use App\Events\BaseEvent;

class ProductDeleted extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $product;
    
    public function __construct(Product $product)
    {
        $this->$product = $product;
        $this->createOperation('delete', 'product', $product->product_code);
    }
}