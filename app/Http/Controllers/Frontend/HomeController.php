<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller{

    public function home(){

        $disk = 'public';

        // 指定目录路径
        $directory = 'carousel';

        // 使用Storage获取目录下的所有文件
        $files = Storage::disk($disk)->files($directory);

        // 筛选出以'promotion'开头的文件
        $promotionImages = array_filter($files, function ($file) {
            return strpos($file, 'promotion') !== false;
        });
        

        return view('frontend.home',compact(
            'promotionImages'
        ));
    }

}