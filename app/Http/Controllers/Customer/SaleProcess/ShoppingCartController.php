<?php

namespace App\Http\Controllers\Customer\SaleProcess;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\ShoppingCartRequest;

class ShoppingCartController extends Controller
{

    public function cart()
    {
        $carts = CartItem::where("user_id" , auth()->user()->id)->get();
        $products = Product::latest()->get();
        return view("customer.sale-process.shopping-cart" , compact("carts" , "products"));
    }

    public function addToCart(ShoppingCartRequest $request, Product $product)
    {

        if (!Auth::check()) {

            return back()->with(["notLogin" => "برای اضاف کردن به سبد خرید و حس کاربری بهتر ثبت نام کنید"]);

        }

        $inputs = $request->all();
        $user = auth()->user()->id;

        $carts = CartItem::where(function ($query) use ($product, $user) {
            $query->where("user_id", $user)->where("product_id", $product->id);
        })->get();

        if (!$carts->isEmpty()) {
            foreach ($carts as $cart) {

                $inputs["warranty_id"] = $cart->warranty_id == null ? null : $inputs["warranty_id"];
                $inputs["color_id"] = $cart->color_id == null ? null : $inputs["color_id"];

                if ($cart->color_id == $inputs["color_id"] && $cart->warranty_id == $inputs["warranty_id"]) {

                    if ($cart->number != $inputs["number"]) {

                        $cart->update(["number" => $inputs["number"]]);
                        return back()->with(["success" => "تعداد محصول تغییر کرد"]);

                    }

                    return back()->with(["success" => "محصول با این امکانات قبلا اضاف شده است"]);

                }

            }
        }

        $inputs["user_id"] = $user;
        $inputs["product_id"] = $product->id;

        CartItem::create($inputs);

        return back()->with(["success" => "محصول به سبد خرید اضاف شد"]);

    }

    public function updateCarts(Request $request)
    {
        foreach($request->input("number") as $key => $value){
            $cart = CartItem::where("id" , $key)->first(["id" , "number"]);
            if($cart->number != $value){
                $cart->number = $value;
                $cart->save();
            }
        }
        
        return redirect()->route("customer.address-delivery");
    }

    public function destory(CartItem $cart)
    {
        $cart->delete();
        return back()->with(["success"=>"محصول شما با موفقیت از سبد خرید حذف شد"]);
    }

}
