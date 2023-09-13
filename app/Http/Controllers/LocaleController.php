<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * @param $lang
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change($lang){

        App::setLocale($lang);

        $expiration = Carbon::now()->addYear()->timestamp; // 设置过期时间为一年后的时间戳
        $cookie = Cookie::make('lang', $lang, $expiration);

        return redirect()->back()->withCookie($cookie);
    }
}