<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Product;

use Illuminate\Http\Request;
use App\Models\Admin\Market\Brand;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\ProductMeta;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        return view("admin.market.showcase.product.index");
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view("admin.market.showcase.product.create", compact("categories", "brands"));
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        $published_at = (int) substr($inputs["published_at"], 0, -3);
        $date = date("Y-m-d H:m:s", $published_at);
        $inputs["published_at"] = $date;

        ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "market" . DIRECTORY_SEPARATOR . "produtc");
        $response = ImageService::resizeAndSave($request->file("image"), 350, 350);
        $inputs["image"] = $response;
        $meta = array_combine($inputs["meta_key"], $inputs["meta_value"]);

        DB::transaction(function () use ($meta, $inputs) {
            $product = Product::create($inputs);

            foreach ($meta as $key => $value) {
                ProductMeta::create([
                    "product_key" => $key,
                    "product_value" => $value,
                    "product_id" => $product->id,
                ]);
            }
        });

        return redirect()->route("admin.market.showcase.product.index")->with(["success" => 'محصول شما با موفقیت ایجاد شد']);
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        return view("admin.market.showcase.product.edit", compact("categories", "brands", "product"));
    }

    public function update(Product $product, Request $request)
    {
        $inputs = $request->all();

        $published_at = (int) substr($inputs["published_at"], 0, -3);
        $date = date("Y-m-d H:m:s", $published_at);
        $inputs["published_at"] = $date;

        if ($request->file("image")) {
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "market" . DIRECTORY_SEPARATOR . "produtc");
            $response = ImageService::resizeAndSave($request->file("image"), 350, 350);
            ImageService::deleteImage($product->image);
            $inputs["image"] = $response;
        }

        $meta = null;

        if (isset($inputs["meta_key"])) {

            $meta_keys = $inputs["meta_key"];
            $meta_values = $inputs["meta_value"];
            $meta_id = array_keys($inputs["meta_key"]);
    
    
            $meta = array_map(function ($key, $value, $id) {
                return
                    [
                        "product_key" => $key,
                        "product_value" => $value,
                        "product_id" => $id,
                    ];
            }, $meta_keys, $meta_values, $meta_id);
        }


        DB::transaction(function () use ($meta, $inputs, $product) {
            $product->update($inputs);

            if ($meta != null) {
                foreach ($meta as $key => $value) {
                    ProductMeta::where("id", $value["product_id"])->first()->update([
                        "product_key" => $value["product_key"],
                        "product_value" => $value["product_value"],
                    ]);
                }
            }

        });

        return redirect()->route("admin.market.showcase.product.index")->with(["success" => 'محصول شما با موفقیت ایجاد شد']);
    }
}
