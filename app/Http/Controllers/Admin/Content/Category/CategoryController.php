<?php

namespace App\Http\Controllers\Admin\Content\Category;

use App\Http\Controllers\Controller;
use App\Http\Services\ImageTest\Image;
use App\Models\Admin\Content\PostCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        return view("admin.content.category.index");
    }

    public function create()
    {
        return view("admin.content.category.create");
    }
    public function store(PostCategoryRequest $request)
    {
        $inputs = $request->all();

        $result = Image::saveGif($inputs["image"]);

        $inputs["image"] = $result;
        PostCategory::create($inputs);
        return redirect()->route("admin.content.category.index")->with(["success" => "عملیات با موفقیت انجام شد !"]);
    }

    public function edit(PostCategory $postCategory)
    {
        return view("admin.content.category.edit", compact("postCategory"));
    }

    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {

        $inputs = $request->all();

        if ($request->hasFile("image")) {
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR . "post-categories");
            $response = ImageService::resizeAndSave($request->file("image"), 700, 500);
            $inputs["image"] = $response;
            ImageService::deleteImage($postCategory->image);
        }

        $postCategory->update($inputs);
        $postCategory->save();
        return redirect()->route("admin.content.category.index")->with(["success" => "بروز رسانی با موفقیت انجام شد !"]);

    }
}
