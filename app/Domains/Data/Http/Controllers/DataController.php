<?php

namespace App\Domains\Data\Http\Controllers;

use App\Domains\Data\Models\Operation;

use App\Domains\Data\Services\DataService;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DataController
{
    public $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * url: admin/data/record
     * method: GET
     * route: backend.admin.data.record
     */
    public function record()
    {
        $operations = Operation::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.admin.data.record', compact('operations'));
    }
    
    /**
     * url: admin/data/import
     * method: GET
     * route: backend.admin.data.import
     */
    public function import()
    {
        return view('backend.admin.data.import');
    }
    
    /**
     * url: admin/data/export
     * method: GET
     * route: backend.admin.data.export
     */
    public function export()
    {
        $collect = collect(DB::select('SHOW TABLES'));
        $tables = $collect->sortBy(function ($table) {
            return array_values((array) $table)[0];
        });
        return view('backend.admin.data.export', compact('tables'));
    }
    
    /**
     * url: admin/data/search
     * method: GET
     * route: backend.admin.data.search
     */
    public function search(Request $request)
    {
        $searchTerm = $request->q;
        if($searchTerm === null){
            return redirect()->route('backend.admin.data.record');
        }

        $operations = $this->dataService->search($request->q);
        return view('backend.admin.data.record', compact('operations'));
    }
}