<?php

namespace App\Http\Controllers\Customer\SaleProcess;

use Carbon\Carbon;
use Zarinpal\Zarinpal;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Admin\Market\Copan;
use App\Models\Admin\Market\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Payment;
use App\Models\Admin\Market\OrderItem;
use App\Models\Admin\Market\CashPayment;
use App\Models\Admin\Market\OnlinePayment;
use App\Models\Admin\Market\OfflinePayment;
use App\Http\Services\Payment\PaymentZarinPal;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = auth()->user();
        $carts = CartItem::where("user_id", $user->id)->get();
        $order = Order::where([["user_id", $user->id], ["order_status", 0]])->latest()->first();
        return view("customer.sale-process.payment", compact("carts", "order"));
    }


    public function checkCopan(Request $request)
    {
        $request->validate([
            "copan" => "required|max:250|exists:copans,code"
        ]);

        $inputs = $request->all();

        $code = $request->input("copan");
        $user = auth()->user();

        $copan = Copan::where([["status", 1], ["start_date", "<=", Carbon::now()], ["end_date", ">=", Carbon::now()], ["code", $code]])->latest()->first();

        if ($copan) {

            $used = Order::where([["user_id", $user->id], ["copan_id", $copan->id], ["order_status", 0]])->first();

            if ($used) {

                return back()->withErrors(["copan" => "شما کد تخفیف را قبلا استفاده کردید"]);

            }

            if ($copan->user_id != null) {

                if ($copan->user_id != $user->id) {
                    return back()->withErrors(["copan", "این کد تخفیف برای شما معتبر نیست"]);
                }

            }

            $order = Order::where([["user_id", $user->id], ["order_status", 0]])->latest()->first();

            $finalProductPrice = $order->order_final_amount;
            $discountPrice = 0;

            if ($copan->amount_type == 0) {

                $discountPrice = $finalProductPrice * ($copan->amount / 100);


                if ($discountPrice > $copan->discount_ceiling) {

                    $discountPrice = $copan->discount_ceiling;

                }

                $finalProductPrice -= $discountPrice;

            } else {

                $finalProductPrice -= $copan->amount;
                $discountPrice = $copan->amount;
            }

            $copan_object = collect([
                "amount" => $copan->amount,
                "amount_type" => $copan->amount_type,
                "discount" => $discountPrice
            ]);

            $inputs["copan_id"] = $copan->id;
            $inputs["copan_object"] = $copan_object;
            $inputs["order_copan_discount_amount"] = $discountPrice;
            $inputs["order_final_amount"] = $finalProductPrice;
            $inputs["order_total_products_discount_amount"] = $order->order_total_products_discount_amount + $discountPrice;

            Order::updateOrCreate(["user_id" => $user->id, "order_status" => 0], $inputs);

            return back()->with(["success" => "کد تخفیف با موفقیت وارد شد"]);

        }

        return back();

    }

    public function buy(Request $request)
    {

        $request->validate([
            "payment_type" => "required|in:1,2,3"
        ]);

        $payment_type = $request->input("payment_type");

        $instance_payment = null;
        $type = 0;

        $user = auth()->user();
        $order = Order::where([["user_id", $user->id], ["order_status", 0]])->latest()->first();

        DB::transaction(function () use ($order, $instance_payment, $user, $payment_type, $type) {

            switch ($payment_type) {
                case "1":
                    $instance_payment = OnlinePayment::class;
                    $type = 1;
                    break;
                case "2":
                    $instance_payment = OfflinePayment::class;
                    $type = 2;
                    break;
                case "3":
                    $instance_payment = CashPayment::class;
                    $type = 3;
                    $cash_recevier = $order->address->recipientFullName();
                    break;
                default:
                    back();

            }

            $another_payment = $instance_payment::create([
                "amount" => $order->order_final_amount,
                "user_id" => $user->id,
                "cash_receiver" => isset($cash_recevier) ? $cash_recevier : null,
                "pay_date" => now()
            ]);

            if ($payment_type == 1) {

                $zarinPal = new PaymentZarinPal();
                $zarinPal->request($another_payment, $another_payment->amount);

            }

            $payment = Payment::create([
                "amount" => $order->order_final_amount,
                "user_id" => $user->id,
                "type" => $type,
                "paymentable_id" => $another_payment->id,
                "paymentable_type" => $instance_payment,
            ]);

            $order->order_status = 3;
            $order->payment_id = $payment->id;
            $order->payment_type = $type;
            $order->save();

            $carts = CartItem::where("user_id", $user->id)->get();


            foreach ($carts as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product' => $item->product,
                    'amazing_sale_id' => empty($item->product->amazingSale->id) ? null : $item->product->amazingSale->id,
                    'amazing_sale_object' => $item->product->amazingSale() ?? null,
                    'amazing_sale_discount_amount' => empty($item->product->amazingSale->amount) ? null : $item->product->amazingSale->amount,
                    'number' => $item->number,
                    'final_product_price' => $item->itemFinalProductPrice(),
                    'final_total_price' => $item->itemFinalPrice(),
                    'color_id' => $item->color_id,
                    'warranty_id' => $item->warranty_id,
                ]);

                $item->delete();

            }

            
        });
        
        return redirect()->route("customer.home")->with(["success" => "خرید شما با موفقیت ثبت شد"]);
    }


    public function paymentCallBack(OnlinePayment $onlinePayment, PaymentZarinPal $paymentZarinPal)
    {
        $amount = $onlinePayment->amount * 10;
        //another works
        dd("callBack");
    }

}
