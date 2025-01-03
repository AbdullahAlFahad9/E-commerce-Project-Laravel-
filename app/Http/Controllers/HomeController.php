<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index(){
        $allproducts = product::latest()->get();
        return view('user_template.home', compact('allproducts'));
    }
}
