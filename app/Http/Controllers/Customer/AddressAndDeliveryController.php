<?php

namespace App\Http\Controllers\Customer;

use App\Models\Admin\Market\CommonDiscount;
use App\Models\Admin\Market\Delivery;
use App\Models\Admin\Market\Order;
use App\Models\Admin\Market\Province;
use App\Models\CartItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Address;
use App\Http\Requests\Customer\AddressRequest;

class AddressAndDeliveryController extends Controller
{

    public function setAddressAndDelivery()
    {
        $addresses = auth()->user()->addresses;
        $delivery = Delivery::all();
        $provinces = Province::get(["id" , "name"]);
        $carts = CartItem::where("user_id" , auth()->user()->id)->get(); 

        return view("customer.sale-process.address-delivery" , compact("addresses" , "provinces" , "delivery" , "carts"));
    }

    public function addAddress(AddressRequest $request)
    {
        $inputs = $request->all();
        $user = auth()->user();

        $inputs["user_id"] = $user->id;

        Address::create($inputs);
        return back();
    }

    public function getCity(Province $province)
    {
        return response()->json($province->cities()->get()->toArray());
    }

    public function editAddress(Address $address)
    {
        return response()->json(["province" => $address->city->province->toArray() , "address" => $address , "route" => route("customer.address-delivery.update.address" , $address->id)]);
    }

    public function updateAddress(AddressRequest $request , Address $address)
    {
        $inputs = $request->all();

        $address->update($inputs);
        return back();
    }

    public function addToOrder(Request $request)
    {
        $request->validate([
            "address" => "required|exists:addresses,id",
            "delivery_type" => "required|exists:delivery,id",
        ]);

        $inputs = $request->all();
        $user = auth()->user();

        $address = Address::find($inputs["address"]);

        $address_object = collect([
            "postal_code" => $address->postal_code,
            "address" => $address->address,
            "no" => $address->no,
            "unit" => $address->unit,
            "recipient_first_name" => $address->recipient_first_name,
            "recipient_last_name" => $address->recipient_last_name,
            "mobile" => $address->mobile
        ]);;



        $delivery = Delivery::find($inputs["delivery_type"]);

        $delivery_object = collect([
            "name" => $delivery->name,
            "amount" => $delivery->amount
        ]);

        $totalProductPrice = 0 ;
        $totalProductPriceWithNumber = 0 ;
        $totalProductDiscountPrice = 0 ;
        $finalProductPrice = 0 ;

        $carts = CartItem::where("user_id" , $user->id)->get();

        foreach($carts as $item){

            $totalProductPrice += $item->itemProductPrice();
            $totalProductPriceWithNumber += $item->itemFinalProductPrice();
            $totalProductDiscountPrice += $item->itemFinalProductDiscount();
            $finalProductPrice += $item->itemFinalPrice();

        }

        $commonDiscount = CommonDiscount::where([["status" , 1] , ["start_date" , "<=" , Carbon::now()] , ["end_date" , ">=" , Carbon::now()]])->latest()->first();

        $percentageToPrice = 0 ;

        if($commonDiscount){

            if($totalProductPriceWithNumber >= $commonDiscount->minimal_order_amount){
                
                $percentageToPrice = $finalProductPrice * ($commonDiscount->percentage / 100);


                if($percentageToPrice > $commonDiscount->discount_ceiling){

                    $percentageToPrice = $commonDiscount->discount_ceiling;

                }

                $finalProductPrice -= $percentageToPrice;

            }

            $common_object = collect([
                "title" => $commonDiscount->title,
                "percentage" => $commonDiscount->percentage,
                "discount_ceiling" => $commonDiscount->discount_ceiling
            ]);
            $inputs["common_discount_id"] = $commonDiscount->id;
            $inputs["common_discount_object"] = $common_object;

        }

        $inputs["user_id"] = $user->id;
        $inputs["order_final_amount"] = $finalProductPrice + $delivery->amount;
        $inputs["order_discount_amount"] = $totalProductDiscountPrice;
        $inputs["order_common_discount_amount"] = $percentageToPrice;
        $inputs["order_total_products_discount_amount"] = $percentageToPrice + $totalProductDiscountPrice;
        $inputs["address_id"] = $inputs["address"];
        $inputs["delivery_id"] = $inputs["delivery_type"];
        $inputs["address_object"] = $address_object;
        $inputs["delivery_object"] = $delivery_object;

        $order = Order::updateOrCreate( ["user_id" => $user->id , "order_status" => 0] , $inputs );

        if($order->copan_id != null){


            $order->order_final_amount -= $order->copan_object["discount"];
            $order->order_total_products_discount_amount += $order->copan_object["discount"];

            $order->save();

        }

        return redirect()->route("customer.sale-process.payment");
    }
}
