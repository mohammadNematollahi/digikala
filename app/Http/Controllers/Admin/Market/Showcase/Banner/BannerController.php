<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Banner;

use Illuminate\Http\Request;
use App\Models\Admin\Market\Banner;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Market\BannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        return view("admin.market.showcase.banner.index");
    }

    public function create()
    {
        $position = Banner::$posision;
        return view("admin.market.showcase.banner.create" , compact("position"));
    }

    public function store(BannerRequest $request)
    {
        $inputs = $request->all();

        
        ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "showcase" . DIRECTORY_SEPARATOR ."banner");
        $response = ImageService::save($request->file("image"));
        
        if ($inputs["image"]->getClientOriginalExtension() == 'gif') {
            $response = ImageService::saveGif($request->file("image"));
        }

        $inputs["image"] = $response;

        Banner::create($inputs);
        return redirect()->route("admin.market.showcase.banner.index")->with(["success" => "عملیات با موفقیت انجام شد !"]);
    }

    public function edit(Banner $banner)
    {
        $position = Banner::$posision;
        return view("admin.market.showcase.banner.edit" , compact("banner" , "position"));
    }

    public function update(Banner $banner , BannerRequest $request)
    {
        $inputs = $request->all();

        if($request->hasFile("image")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "showcase" . DIRECTORY_SEPARATOR ."banner");
            $response = ImageService::save($request->file("image"));
            ImageService::deleteImage($banner->image);
            $inputs["image"] = $response;
        }

        $banner->update($inputs);
        return redirect()->route("admin.market.showcase.banner.index")->with(["success" => "بروز رسانی با موفقیت انجام شد !"]);
    }
}
