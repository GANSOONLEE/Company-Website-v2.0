<?php

namespace App\Domains\Model\Events;

use App\Domains\Model\Models\Model;
use Illuminate\Queue\SerializesModels;
use App\Events\BaseEvent;

class ModelCreated extends BaseEvent
{
    use SerializesModels;

    /**
     * @var
     */
    public $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->createOperation('create', 'model', $model->name);
    }
}