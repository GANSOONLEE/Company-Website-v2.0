<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;


class ReportBugController extends Controller{

    public function reportBug(){
        return view('backend.admin.report-bug');
    }
    
}