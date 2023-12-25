<?php

namespace App\Http\Controllers\Backend\Admin\Category;

use App\Http\Controllers\Controller;
use App\Domains\Category\Models\Category;
use Illuminate\Support\Facades\Storage;

class CreateCategoryController extends Controller
{
    public function createCategory(){

        // check permission
        if(!(auth()->user()->getRoleEntity()->hasPermission('admin_category'))){
            abort(403, 'Insufficient permissions');
        };

        return view('backend.admin.category.create-category');
    }
}
