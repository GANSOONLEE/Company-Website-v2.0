<?php

namespace App\Domains\Data\Http\Controllers;

use App\Domains\Data\Models\Operation;

use App\Domains\Data\Services\DataService;

use Illuminate\Support\Facades\Storage;
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
        $collect = collect(DB::select('SHOW TABLES'));
        $tables = $collect->sortBy(function ($table) {
            return array_values((array) $table)[0];
        });
        $filePath = Storage::disk('backup_disk')->path('');
        return view('backend.admin.data.import', compact('tables', 'filePath'));
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
     * url: admin/data/import-data
     * method: POST
     * route: backend.admin.data.importData
     * @param Request $request
     */
    public function importData(Request $request)
    {
        $result = $this->dataService->importWithSQL($request->table);
        $count = count($result);
        return redirect()->back()->with('success', trans('data.import-data-success', ["count" => $count]));
    }

    /**
     * url: admin/data/export-data
     * method: POST
     * route: backend.admin.data.exportData
     * @param Request $request
     */
    public function exportData(Request $request)
    {
        $result = $this->dataService->exportWithSQL($request->table);
        $count = count($result);
        return redirect()->back()->with('success', trans('data.export-data-success', ["count" => $count]));
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