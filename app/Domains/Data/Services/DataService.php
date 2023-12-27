<?php

namespace App\Domains\Data\Services;

use App\Domains\Data\Models\Operation;

use App\Services\BaseService;

class DataService extends BaseService
{
    public function __construct(Operation $operation)
    {
        $this->model = $operation;
    }

    /**
     * Search operation record
     * @param string $searchTerm
     * @return mixed
     */
    public function search(string $searchTerm): mixed
    {
        return Operation::where(function ($query) use ($searchTerm) {
                            $query->where('operation_type', 'like', "%$searchTerm%")
                                ->orWhere('operation_category', 'like', "%$searchTerm%")
                                ->orWhere('operation_detail', 'like', "%$searchTerm%")
                                ->orWhere('email', 'like', "%$searchTerm%");
                        })
                        ->orderBy('created_at', 'desc')
                        ->groupBy('id')
                        ->paginate(10)
                        ->withQueryString();
    }
}