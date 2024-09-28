<?php

namespace App\Http\Controllers\Customer\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function myOrders()
    {
        $userOrders = auth()->user()->orders;
        return view("customer.dashboard.my-orders" , compact("userOrders"));
    }
}
