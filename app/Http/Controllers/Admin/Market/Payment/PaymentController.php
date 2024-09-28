<?php

namespace App\Http\Controllers\Admin\Market\Payment;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function allPayments()
    {

        return view("admin.market.payment.index");
    }
    public function onlinePayments()
    {
        return view("admin.market.payment.index");
    }
    public function offlinePayments()
    {
        return view("admin.market.payment.index");
    }
    public function onSidePayments()
    {
        return view("admin.market.payment.index");
    }

    public function show(Payment $payment)
    {
        return view("admin.market.payment.show" , compact("payment"));
    }
}
