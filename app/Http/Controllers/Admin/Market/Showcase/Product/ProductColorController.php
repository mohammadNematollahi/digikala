<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Product;

use App\Http\Requests\Admin\Market\ProductColorRequest;
use App\Models\Admin\Market\ProductColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;

class ProductColorController extends Controller
{
    public function index(Product $product)
    {
        return view("admin.market.showcase.product.product-color.index" , compact("product"));
    }

    public function create(Product $product)
    {
        return view("admin.market.showcase.product.product-color.create" , compact("product"));
    }

    public function store(Product $product , ProductColorRequest $request)
    {
        $inputs = $request->all();
        $inputs["product_id"] = $product->id;
        ProductColor::create($inputs);
        return redirect()->route("admin.market.showcase.product-color.index" , $product->slug)->with(["success" => 'رنگ شما با موفقیت ثبت شد']);
    }

    public function edit(Product $product , ProductColor $color)
    {
        return view("admin.market.showcase.product.product-color.edit" , compact("product" , "color"));
    }

    public function update(Product $product , ProductColor $color , ProductColorRequest $request)
    {
        $inputs = $request->all();
        $color->update($inputs);
        $color->save();
        return redirect()->route("admin.market.showcase.product-color.index" , $product->slug)->with(["success" => 'رنگ شما با موفقیت بروز رسانی شد']);
    }

    public function destroy(Product $product , ProductColor $color)
    {
        $color->delete();
        $color->save();
        return redirect()->route("admin.market.showcase.product-color.index" , $product->slug)->with(["success" => 'رنگ شما با موفقیت بروز رسانی شد']);
    }

    public function status(Product $product , ProductColor $color)
    {
        $status = $color->status == 0 ? 1 : 0;
        $color->update(["status" => $status]);
        return redirect()->route("admin.market.showcase.product-color.index" , $product->slug)->with(["success" => 'وضعیت رنگ شما با موفقیت تغییر کرد']);
    }
}
