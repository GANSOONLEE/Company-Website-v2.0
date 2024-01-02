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

        // 指定目录路径
        $directory = 'carousel';
        $promotionImages = [];

        // 使用Storage获取目录下的所有文件
        $directories = Storage::disk($disk)->allDirectories($directory);

        // 當前身分組
        $role = auth()->user()->roles()->first()->name;
        
        $promotionImages = [];

        # TODO 解開 array
        foreach($directories as $directory) {
            $allow_roles = Image::where('name', basename($directory))->first()->allow_roles;
            if(array_search($role, $allow_roles) > 0){
                $promotionImages[] = Storage::disk('public')->allFiles($directory);
            }
        }

        dd($promotionImages);

        // Get current location directory

        // $promotionDirectories = Storage::disk($disk)->directories($directory);

        // foreach ($promotionDirectories as $promotionDirectory){

        //     $parts = explode("/", $promotionDirectory);
        //     $lastWord = end($parts);

        //     // check permission
        //     if(auth()->check()){
        //         if(!auth()->user()->getRoleEntity()->hasPermission("promotion_$lastWord")){
        //             continue;
        //         }
        //     }

        //     $files = Storage::disk($disk)->files($promotionDirectory);

        //     if(!$files){
        //         continue;
        //     }

        //     foreach ($files as $file){
        //         $promotionImages[] = $file;
        //     }
            
        // }

        // 筛选出以'promotion'开头的文件
        // $promotionImages = array_filter($files, function ($file) {
        //     return strpos($file, 'promotion') !== false;
        // });

        return view('frontend.home',compact(
            'promotionImages'
        ));
    }

}