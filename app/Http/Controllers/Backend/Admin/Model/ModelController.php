<?php

namespace App\Http\Controllers\Backend\Admin\Model;

use App\Http\Controllers\Controller;

use App\Domains\Model\Request\CreateModelRequest;
use App\Domains\Model\Services\ModelService;

use App\Models\CarModel as Model;
use Illuminate\Http\Request;

class ModelController extends Controller
{

    protected $modelService;

    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    /**
     * url: admin/model/
     * method: get
     * name: backend.admin.model.index
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.admin.model.index');
    }

    /**
     * url: admin/model/create
     * method: get
     * name: backend.admin.model.create
     * 
     * @return mixed
     */
    public function create()
    {
        return view('backend.admin.model.create');
    }

    /**
     * url: admin/model/
     * method: post
     * name: backend.admin.model.store
     * 
     * @param CreateModelRequest $request
     * 
     * @return mixed
     * @throws \Throwable
     */
    public function store(CreateModelRequest $request){

        $model = $this->modelService->store($request->validated());

        return redirect()->back();

    }

    /**
     * url: admin/model/edit
     * method: get
     * name: backend.admin.model.edit
     * 
     * @param Model $model
     * 
     * @return mixed
     */
    public function edit(){

    }

    /**
     * url: admin/model/{model}
     * method: patch
     * name: backend.admin.model.update
     */
    public function update(Request $request){

    }

    /**
     * url: admin/model/{model}
     * method: delete
     * name: backend.admin.model.destroy
     * @param $model
     */
    public function destroy($model){

    }

}
