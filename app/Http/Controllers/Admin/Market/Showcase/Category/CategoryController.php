<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\ProductCategory;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view("admin.market.showcase.category.index");
    }

    public function create()
    {
        $parent_menus = ProductCategory::whereNull("parent_id")->get();
        return view("admin.market.showcase.category.create" , compact("parent_menus"));
    }

    public function store(ProductCategoryRequest $request)
    {
        $inputs = $request->all();
        ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "showcase" . DIRECTORY_SEPARATOR ."product-categories");
        $response = ImageService::resizeAndSave($request->file("image") , 500 , 350);
        $inputs["image"] = $response;
        ProductCategory::create($inputs);
        return redirect()->route("admin.market.showcase.category.index")->with(["success" => "عملیات با موفقیت انجام شد !"]);
    }

    public function edit(ProductCategory $category)
    {
        $parent_menus = ProductCategory::whereNull("parent_id")->get();
        return view("admin.market.showcase.category.edit" , compact("category" , "parent_menus"));
    }

    public function update(ProductCategory $category , ProductCategoryRequest $request)
    {
        $inputs = $request->all();

        if($request->hasFile("image")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "showcase" . DIRECTORY_SEPARATOR ."product-categories");
            $response = ImageService::resizeAndSave($request->file("image") , 500 , 350);
            $inputs["image"] = $response;
            ImageService::deleteImage($category->image);
        }

        $category->update($inputs);
        $category->save();
        return redirect()->route("admin.market.showcase.category.index")->with(["success" => "بروز رسانی با موفقیت انجام شد !"]);
    }
}
