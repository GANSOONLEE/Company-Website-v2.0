<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Domains\Category\Models\Category;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller{

    public function contact(){

        return view('frontend.contact');

    }
    
}
