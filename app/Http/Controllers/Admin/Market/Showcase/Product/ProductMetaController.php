<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductMetaRequest;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\ProductMeta;
use Illuminate\Http\Request;

class ProductMetaController extends Controller
{
    public function index(Product $product)
    {
        return view("admin.market.showcase.product.product-meta.index" , compact("product"));
    }
    
    public function create(Product $product)
    {
        return view("admin.market.showcase.product.product-meta.create" , compact("product"));
    }

    public function store(Product $product , ProductMetaRequest $request)
    {
        $inputs = $request->all();
        $inputs["product_id"] = $product->slug;
        ProductMeta::create($inputs);
        return redirect()->route("admin.market.showcase.product-meta.index" , $product->id)->with(["success" => "قابلیت شما با موفقیت ایجاد شد"]);
    }

    public function destroy(Product $product , ProductMeta $productMeta)
    {
        $productMeta->delete();
        $productMeta->save();
        return redirect()->route("admin.market.showcase.product-meta.index" , $product->slug)->with(["success" => "قابلیت شما با موفقیت حذف شد"]);
    }
}
