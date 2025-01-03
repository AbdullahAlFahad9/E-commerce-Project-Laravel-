<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboardcontroller extends Controller
{
    public function Index(){
        return view("admin.dashboard");
       }
    
    
}
