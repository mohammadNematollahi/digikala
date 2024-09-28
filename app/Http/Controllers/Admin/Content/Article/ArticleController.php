<?php

namespace App\Http\Controllers\Admin\Content\Article;

use App\Http\Controllers\Controller;
use App\Models\Admin\Content\Article;
use App\Models\Admin\Content\PostCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\ArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        return view("admin.content.article.index");
    }

    public function create()
    {
        $categories = PostCategory::get(["id" , "name"]);
        return view("admin.content.article.create" , compact("categories"));
    }

    public function store(ArticleRequest $articleRequest)
    {
        $inputs = $articleRequest->all();
        $published_at = (int)substr($inputs["published_at"] , 0 , -3);
        $date = date("Y-m-d H:m:s" , $published_at);
        ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR ."posts");
        $response = ImageService::resizeAndSave($articleRequest->file("image") , 700 , 500);
        $inputs["image"] = $response;
        $inputs["published_at"] = $date;
        $inputs["author_id"] = 1;
        Article::create($inputs);
        return redirect()->route("admin.content.article.index")->with(["success" => "عملیات با موفقیت انجام شد !"]);
    }

    public function edit(Article $article)
    {
        $categories = PostCategory::get(["id" , "name"]);
        return view("admin.content.article.edit" , compact("article" , "categories"));
    }

    public function update(ArticleRequest $articleRequest , Article $article)
    {
        $inputs = $articleRequest->all();

        if($articleRequest->hasFile("image")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "content" . DIRECTORY_SEPARATOR ."posts");
            $response = ImageService::resizeAndSave($articleRequest->file("image") , 700 , 500);
            $inputs["image"] = $response;
            ImageService::deleteImage($article->image);
        }

        $published_at = (int)substr($inputs["published_at"] , 0 , -3);
        $date = date("Y-m-d H:m:s" , $published_at);
        $inputs["published_at"] = $date;

        $article->update($inputs);
        $article->save();
        return redirect()->route("admin.content.article.index")->with(["success" => "بروز رسانی با موفقیت انجام شد !"]);
    }
}
