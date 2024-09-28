<?php

namespace App\Http\Livewire\Admin\Market\Order;

use Livewire\Component;
use App\Models\Admin\Market\Order;
use Illuminate\Support\Facades\Route;

class Index extends Component
{
    public $currentUrl;

    public function mount()
    {
        $this->currentUrl = Route::currentRouteName();
    }

    public function render()
    {

        $current_page = explode(".", $this->currentUrl)[3];

        if($current_page == "allOrders")
        {
            $orders = Order::latest()->get();
        }elseif($current_page == "sending")
        {
            $orders = Order::where("delivery_status" , 1)->latest()->get();
        }elseif($current_page == "unpaid")
        {
            $orders = Order::where("payment_status" , 0)->latest()->get();
        }elseif($current_page == "canceled")
        {
            $orders = Order::where("order_status" , 4)->latest()->get();
        }elseif($current_page == "returned")
        {
            $orders = Order::where("order_status" , 5)->latest()->get();
        }else{
            $orders = Order::where(function($query){
                $query->where("order_status" , 0)->orWhere("order_status", 1);
            })->latest()->get();
        }

        return view('livewire.admin.market.order.index' , compact("orders"));
    }

    public function deliveryStatus(Order $order)
    {
        $delivery_status = $order->delivery_status ;
        if($delivery_status == 0){
            $delivery_status = 1;
        }elseif($delivery_status == 1){
            $delivery_status = 2;
        }elseif($delivery_status == 2){
            $delivery_status = 3;
        }elseif($delivery_status == 3){
            $delivery_status = 0;
        }

        $order->delivery_status = $delivery_status;
        $order->save();
    }

    public function orderStatus(Order $order)
    {
        $order_status = $order->order_status ;
        if($order_status == 0){
            $order_status = 1;
        }elseif($order_status == 1){
            $order_status = 2;
        }elseif($order_status == 2){
            $order_status = 3;
        }elseif($order_status == 3){
            $order_status = 4;
        }elseif($order_status == 4){
            $order_status = 5;
        }elseif($order_status == 5){
            $order_status = 0;
        }

        $order->order_status = $order_status;
        $order->save(); 
    }

    public function returned(Order $order)
    {
        $order->order_status = 4;
        $order->save(); 
    }
}
