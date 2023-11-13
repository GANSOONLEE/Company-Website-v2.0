<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserDataPostController extends Controller
{
    public function userPostData(Request $request){

        // Get data
        $user = auth()->user();

        $user->update([
            'whatsapp_phone' => $request->whatsapp_phone,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
        ]);


        return redirect()->back();

    }
}
