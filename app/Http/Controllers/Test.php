<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Pusher\Pusher;

class Test extends Controller
{

    function test(Request $request){
        $socketId = $request->input('socket_id');
        $channelName= $request->input('channel_name');

        /** @var Pusher $pusher */
        $pusher = App::make(Pusher::class, [
            'auth_key' => config('broadcasting.connections.pusher.key'),
            'secret'   => config('broadcasting.connections.pusher.secret'),
            'app_id'   => config('broadcasting.connections.pusher.app_id')
        ]);

        //回傳token

        $returnData = $pusher->socket_auth($channelName, $socketId);
        return response($returnData, 200)->header('Content-Type', 'application/json');
    }


}