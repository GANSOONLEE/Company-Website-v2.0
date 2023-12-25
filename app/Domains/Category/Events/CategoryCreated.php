<?php

namespace App\Domains\Category\Events;

use App\Domains\Category\Models\Category;
use Illuminate\Queue\SerializesModels;

class CategoryCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}