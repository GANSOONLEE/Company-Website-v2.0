<?php

namespace App\Events;

use App\Domains\Data\Models\Operation;

use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;

class BaseEvent
{
    public $operation;

    protected function __construct()
    {
    }

    /**
     * @param string $type
     * @param string $category
     * @param string $detail
     * 
     * @return void
     */
    protected function createOperation(string $type, string $category, string $detail): void
    {

        DB::beginTransaction();

        try {
            Operation::create([
                'email' => auth()->user()->email,
                'operation_type' => $type,
                'operation_category' => $category,
                'operation_detail' => $detail,
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getLine(), $e->getFile());
            throw new GeneralException('There was an problem creating the operation record.');
        }

        DB::commit();
    }

}