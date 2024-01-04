<?php

namespace App\Domains\Category\Events;

use App\Domains\Category\Models\Category;
use Illuminate\Queue\SerializesModels;
use App\Events\BaseEvent;

class CategoryCreated extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $category;
    
    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->createOperation('create', 'category', $category->name);
    }
}