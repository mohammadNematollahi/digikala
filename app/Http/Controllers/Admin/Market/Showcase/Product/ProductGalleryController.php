<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Product;

use App\Http\Requests\Admin\Market\ProductGalleryRequest;
use App\Models\Admin\Market\ProductGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use App\Http\Services\Image\ImageService;

class ProductGalleryController extends Controller
{
    public function index(Product $product)
    {
        return view("admin.market.showcase.product.product-gallery.index" , compact("product"));
    }

    public function create(Product $product)
    {
        return view("admin.market.showcase.product.product-gallery.create" , compact("product"));
    }

    public function store(Product $product , ProductGalleryRequest $request)
    {
        $inputs = $request->all();
        ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "market" . DIRECTORY_SEPARATOR ."produtc" . DIRECTORY_SEPARATOR ."gallery");
        $response = ImageService::save($request->file("image"));
        $inputs["image"] = $response;
        $inputs["product_id"] = $product->id;

        ProductGallery::create($inputs);
        return redirect()->route("admin.market.showcase.product-gallery.index" , $product->slug)->with(["success" => "عکس شما با موفقیت ایجاد شد"]);
    }

    public function destroy(ProductGallery $productGallery)
    {
        ImageService::deleteImage($productGallery->image);
        $productGallery->delete();
        return redirect()->route("admin.market.showcase.product-gallery.index" , $productGallery->product->slug)->with(["success" => "عکس شما با موفقیت حذف شد"]);
    }
}
