<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Brand;

use App\Models\Admin\Market\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\BrandRequest;

class BrandController extends Controller
{
    public function index()
    {
        return view("admin.market.showcase.brand.index");
    }

    public function create()
    {
        return view("admin.market.showcase.brand.create");
    }
    public function store(BrandRequest $request)
    {
        $inputs = $request->all();
        ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "showcase" . DIRECTORY_SEPARATOR ."brand");
        $response = ImageService::save($request->file("logo"));
        $inputs["logo"] = $response;
        Brand::create($inputs);
        return redirect()->route("admin.market.showcase.brand.index")->with(["success" => "عملیات با موفقیت انجام شد !"]);
    }

    public function edit(Brand $brand)
    {
        return view("admin.market.showcase.brand.edit" , compact("brand"));
    }

    public function update(Brand $brand , BrandRequest $request)
    {
        $inputs = $request->all();

        if($request->hasFile("logo")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "showcase" . DIRECTORY_SEPARATOR ."brand");
            $response = ImageService::save($request->file("logo"));
            $inputs["logo"] = $response;
            ImageService::deleteImage($brand->image);
        }

        $brand->update($inputs);
        $brand->save();
        return redirect()->route("admin.market.showcase.brand.index")->with(["success" => "بروز رسانی با موفقیت انجام شد !"]);
    }
}
