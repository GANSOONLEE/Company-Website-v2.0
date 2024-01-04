<?php

namespace App\Http\Controllers\Backend\Admin\Model;

use App\Domains\Model\Events\ModelDeleted;
use App\Http\Controllers\Controller;

use App\Domains\Model\Request\CreateModelRequest;
use App\Domains\Model\Request\UpdateModelRequest;
use App\Domains\Model\Services\ModelService;

use App\Exceptions\GeneralException;

use App\Domains\Model\Models\Model as Model;
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
        return redirect()->back()->with('success', __('model.create-model-success', ["model" => $model->name]));

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
        return view('backend.admin.model.edit');
    }

    /**
     * url: admin/model/{model}
     * method: patch
     * name: backend.admin.model.update
     * 
     * @param string $id
     * @param UpdateModelRequest $request
     * 
     * @return mixed
     * @throws \Throwable
     */
    public function update($id, UpdateModelRequest $request){
        $model = $this->modelService->update($id, $request->validated());
        return redirect()->back()->with('success', __('model.update-model-success', ["model" => $model->name]));
    }

    /**
     * url: admin/model/{model}
     * method: delete
     * name: backend.admin.model.destroy
     * @param $id
     */
    public function destroy($id){
        
        // check this model exists
        $model = Model::where('id', $id)->first();
        $model ? null : throw new GeneralException('Can\'t find this model');

        $name = $model->name;

        // check have any product in this model
        $products = \Illuminate\Support\Facades\DB::table('products_name')
                        ->where('name', 'LIKE', "%$name%")
                        ->count();
        $products === 0 ? null : throw new GeneralException('This model has products, please change the model!');

        $model->delete();
        event(new ModelDeleted($model));

        return redirect()->back()->with('success', __('model.delete-model-success', ["model" => $name]));
    }

}
