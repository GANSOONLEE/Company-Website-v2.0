<?php

namespace App\Domains\Bug\Events;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Mail\BugReport;

class BugReportEvent{

    public function bugReport(Request $request){

        try{

            if(!isset($request->additional)){
                $additional = '';
            }else{
                $additional = $request->additional;
            }
    
            $data = (object)[
                'email' => $request->email,
                'datetime' => $request->datetime,
                'screenshot' => $request->file('screenshot'),
                'description' => $request->description,
                'additional' => $additional,
            ];
            
            Mail::to(config('function.email_developer'))->send(new BugReport($data));

            $data = [
                'status' => 'successful',
                'message' => trans('bug.send-success'),
            ];
    
        }catch(\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());
            $data = [
                'status' => 'failure',
                'message' => trans('bug.send-failure'),
            ];
        }
       
        return redirect()->back()->withCookie(cookie(
            'sessionData',
            json_encode($data),
            0.05,
            null,
            null,
            false,
            false,
            true
        ));

    }

}