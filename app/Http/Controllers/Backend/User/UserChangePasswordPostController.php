<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserChangePasswordPostController extends Controller
{
    public function userChangePassword(Request $request){

        try{

            if(!auth()->check()){
                return false;
            }

            $currentPassword = $request->input("current-password");
            $password = $request->input("new-password");
            $user = auth()->user();

            if (!Auth::attempt(['email' => $user->email, 'password' => $currentPassword])) {

                $result = [
                    'status' => 'Password error',
                    'icon' => 'error',
                ];

            }else{

                $user->update([
                    'password' => $password,
                ]);
        
                $result = [
                    'status' => 'Successful save!', 
                    'icon' => 'success',
                ];

            }
            
        }catch(\Exception $e){
            $result = [
                'status' => 'That have something happen!',
                'icon' => 'warning',
            ];
        }
        
        return response()->json($result);
    }
}
