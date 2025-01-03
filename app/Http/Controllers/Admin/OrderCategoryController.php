<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderCategoryController extends Controller
{
    public function index(){
        $pending_orders =  Order::where('status','pending')->latest()->get();
        return view("admin.pendingorders", compact('pending_orders'));
    }

    public function AddOrders(){
        return view("admin.completeorders");
    }
}
