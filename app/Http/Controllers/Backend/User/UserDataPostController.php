<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Domains\Auth\Models\User;

class UserDataPostController extends Controller
{
    public function userPostData(Request $request){

        try{

            // Get data
            $user = auth()->user();
    
            $user->update([
                'whatsapp_phone' => $request->whatsapp_phone,
                'contact_phone' => $request->contact_phone,
                'address' => $request->address,
            ]);
    
            $status = [
                'status' => 'Successful save!', 
                'icon' => 'success',
            ];
            
        }catch(\Exception $e){
            $status = [
                'status' => 'That have something happen!',
                'icon' => 'warning',
            ];
        }
        
        return response()->json($status);
    }
}
