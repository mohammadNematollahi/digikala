<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Product;

use App\Models\Admin\Market\Warranty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use App\Http\Requests\Admin\Market\WarrantyRequest;

class WarrantyController extends Controller
{
    public function index(Product $product)
    {
        return view("admin.market.showcase.product.warranty.index" , compact("product"));
    }

    public function create(Product $product)
    {
        return view("admin.market.showcase.product.warranty.create" , compact("product"));
    }

    public function store(Product $product , WarrantyRequest $request)
    {
        $inputs = $request->all();
        $inputs["product_id"] = $product->id;
        Warranty::create($inputs);
        return redirect()->route("admin.market.showcase.warranty.index" , $product->slug)->with(["success" => 'گارانتی شما با موفقیت ثبت شد']);
    }

    public function edit(Product $product , Warranty $warranty)
    {
        return view("admin.market.showcase.product.warranty.edit" , compact("product" , "warranty"));
    }

    public function update(Product $product , Warranty $warranty , WarrantyRequest $request)
    {
        $inputs = $request->all();
        $warranty->update($inputs);
        return redirect()->route("admin.market.showcase.warranty.index" , $product->slug)->with(["success" => 'گارانتی شما با موفقیت بروز رسانی شد']);
    }

    public function destroy(Product $product , Warranty $warranty)
    {
        $warranty->delete();
        return redirect()->route("admin.market.showcase.warranty.index" , $product->slug)->with(["success" => 'گارانتی شما با موفقیت بروز رسانی شد']);
    }

    public function status(Product $product , Warranty $warranty)
    {
        $status = $warranty->status == 0 ? 1 : 0;
        $warranty->update(["status" => $status]);
        return redirect()->route("admin.market.showcase.warranty.index" , $product->slug)->with(["success" => 'وضعیت گارانتی شما با موفقیت تغییر کرد']);
    }
}
