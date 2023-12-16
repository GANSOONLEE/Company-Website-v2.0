<?php

namespace App\Domains\Auth\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordEvent {

    public function resetPassword(Request $request){

        try{

            $email = $request->email;

            $user = \App\Domains\Auth\Models\User::where('email', $email)->first();

            if($user){

                Mail::to($email)->send(new \App\Mail\ResetPassword($user));

                $result = [
                    'message' => 'Successfully sent email !',
                    'icon' => 'success'
                ];
            }else{

                $result = [
                    'message' => 'We can\'t find this email address !',
                    'icon' => 'error'
                ];
            }

        }catch (\Exception $e){
            $result = [
                'message' => 'Something happen !',
                'icon' => 'error',
                'errorMessage' => $e->getMessage(),
            ];
        }



        return response()->json($result);
    }

}