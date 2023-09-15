<?php

namespace App\Http\Controllers\Backend\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class CreateBrandController extends Controller
{
    public function createBrand(){

        // check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_brand'))){
            abort(403, 'Insufficient permissions');
        };

        return view('backend.admin.brand.create-brand');
    }
}
