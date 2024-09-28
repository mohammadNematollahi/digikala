<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use App\Http\Requests\Admin\Market\StoreRequest;

class StoreController extends Controller
{
    public function index()
    {
        return view("admin.market.showcase.store.index");
    }

    public function addToStore(Product $product)
    {
        return view("admin.market.showcase.store.add-to-store" , compact("product"));
    }

    public function store(StoreRequest $request , Product $product)
    {
        $inputs = $request->all();
        Log::info("نام تحویل دهنده : {$inputs['name_receiver']} | نام گیرنده : {$inputs['name_deliverer']} | توضیحات : {$inputs['description']}");
        $product->marketable_number += $inputs["marketable_number"];
        $product->save();
        return redirect()->route("admin.market.showcase.store.index")->with(["افزایش موجودی باموفقیت انجام شد"]); 
    }
    public function editStore(Product $product)
    {
        return view("admin.market.showcase.store.edit-store" , compact("product"));
    }

    public function updateStore(Product $product , StoreRequest $request)
    {
        $inputs = $request->all();
        $product->update($inputs);
        $product->marketable_number = $inputs["marketable_number"];
        $product->marketable_number -= ($product->sold_number + $product->frozen_number);
        $product->save();
        return redirect()->route("admin.market.showcase.store.index")->with(["اصلاح موجودی باموفقیت انجام شد"]); 
    }

}
