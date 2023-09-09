<?php

namespace App\Domains\Notification\Services;

use App\Mail\RegisterVerify;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterVerifyService
{
    public function verify(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email'
        // ]);

        // if($validator->fails()){
        //     return new JsonResponse(['success'=> false, 'message'=> $validator->errors()], 422);
        // }

        // $email = $request->all()['email'];
        $email = 'axun0402@gmail.com';
        Mail::to($email)->send(new RegisterVerify($email));
    } 

}