<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\RegisterVerify;
use App\Domains\Auth\Models\Permission;
use App\Domains\Image\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller{

    public function home(){

        $disk = 'public';

        $directory = 'carousel';
        $promotionImages = [];

        $directories = Storage::disk($disk)->allDirectories($directory);

        $role = auth()->check() ?
            auth()->user()->roles()->first()->name :
            null ;

        foreach($directories as $directory) {
            $allow_roles = Image::where('name', basename($directory))->first()->allow_roles;
            if(array_search($role, $allow_roles) !== false){
                $promotionImages = array_merge($promotionImages, Storage::disk('public')->files($directory));
            }else if(strpos(basename($directory), 'general') === 0){
                $promotionImages = array_merge($promotionImages, Storage::disk('public')->files($directory));
            }
        }

        return view('frontend.home',compact(
            'promotionImages'
        ));
    }

}