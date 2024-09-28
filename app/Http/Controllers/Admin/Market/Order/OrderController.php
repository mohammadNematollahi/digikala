<?php

namespace App\Http\Controllers\Admin\Market\Order;

use Illuminate\Http\Request;
use App\Models\Admin\Market\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function newOrders()
    {
        return view("admin.market.order.index");
    }

    public function sending()
    {
        return view("admin.market.order.index");
    }

    public function unpaid()
    {
        return view("admin.market.order.index");
    }

    public function canceled()
    {
        return view("admin.market.order.index");
    }

    public function returned()
    {
        return view("admin.market.order.index");
    }

    public function allOrders()
    {
        return view("admin.market.order.index");
    }

    public function show(Order $order)
    {
        return view("admin.market.order.show" , compact("order"));
    }

    public function detail(Order $order)
    {
        return view("admin.market.order.detail" , compact("order"));
    }
}
