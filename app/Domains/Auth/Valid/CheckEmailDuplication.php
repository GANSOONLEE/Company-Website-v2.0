<?php

namespace App\Domains\Auth\Valid;

use App\Models\User;
use Illuminate\Http\Request;

class CheckEmailDuplication{

    public function checkEmailDuplication(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->exists();
        $result = ['emailExists' => $user];

        return response()->json($result);
    }

}
