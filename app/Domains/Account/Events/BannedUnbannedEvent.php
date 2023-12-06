<?php

namespace App\Domains\Account\Events;

use Illuminate\Http\Request;

class BannedUnbannedEvent{

    public function bannedUnbanned(Request $request){

        $email = $request->email;
        $method = $request->method;

        $user = \App\Models\User::where('email', $email)->first();

        if($method == "banned"){
            $data = [
                "status" => "Unavailable",
            ];
        }else{
            $data = [
                "status" => "Available",
            ];
        }
        $user->update($data);

        return response()->json();

    }

}