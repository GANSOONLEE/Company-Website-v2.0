<?php

namespace App\Domains\GasOil\Http\Controllers;

// Service
use App\Domains\GasOil\Services\GasOilService;

// Request
use App\Domains\GasOil\Requests\CreateGasOilRequest;
use App\Domains\GasOil\Requests\UpdateGasOilRequest;

// Controller
use App\Http\Controllers\Controller;

class GasOilController extends Controller
{

    public $gasOilService;

    public function __construct(GasOilService $gasOilService)
    {
        $this->gasOilService = $gasOilService;
    }

    /**
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        return view('frontend.gas-oil');
    }

    /**
     * create GasOil
     * @param CreateGasOilRequest $request
     */
    public function store(CreateGasOilRequest $request)
    {
        // dd($request->validated());
        $this->gasOilService->store();
    }

    /**
     * create GasOil
     * @param UpdateGasOilRequest $request
     */
    public function update(UpdateGasOilRequest $request)
    {
        // dd($request->validated());
        $this->gasOilService->update();
    }

    /**
     * create GasOil
     * @param string $id
     */
    public function destroy(string $id)
    {
        // dd($id);
        $this->gasOilService->destroy($id);
    }

}