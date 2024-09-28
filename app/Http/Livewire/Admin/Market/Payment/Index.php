<?php

namespace App\Http\Livewire\Admin\Market\Payment;

use App\Models\Admin\Market\CashPayment;
use App\Models\Admin\Market\OfflinePayment;
use App\Models\Admin\Market\OnlinePayment;
use Livewire\Component;
use App\Models\Admin\Market\Payment;
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

        if($current_page == "allPayments")
        {
            $payments = Payment::with(["paymentable"])->latest()->get();
        }
        else if($current_page == "onlinePayments"){

            $payments = Payment::with(["paymentable"])->where("paymentable_type" , OnlinePayment::class)->latest()->get();
        }
        else if($current_page == "offlinePayments"){

            $payments = Payment::with(["paymentable"])->where("paymentable_type" , OfflinePayment::class)->latest()->get();
        }else{

            $payments = Payment::with(["paymentable"])->where("paymentable_type" , CashPayment::class)->latest()->get();
        }
            
        return view('livewire.admin.market.payment.index' , compact("payments"));
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2 ;
        $payment->paymentable->status = 2 ;
        $payment->save();
        $payment->paymentable->save();
        return redirect()->route("admin.market.payment.allPayments")->with(["success" => "تغییرات با موفقیت ثبت شد"]);
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->paymentable->status = 3;
        $payment->save();
        $payment->paymentable->save();
        return redirect()->route("admin.market.payment.allPayments")->with(["success" => "تغییرات با موفقیت ثبت شد"]);
    }
}
