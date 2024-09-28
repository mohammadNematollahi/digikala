<?php

namespace App\Http\Controllers\Admin\Content\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;
use App\Models\Admin\Content\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view("admin.content.page.index");
    }

    public function create()
    {
        return view("admin.content.page.create");
    }

    public function store(PageRequest $pageRequest)
    {
        $inputs = $pageRequest->all();
        Page::create($inputs);
        return redirect()->route("admin.content.page.index")->with(["success" => "صفحه شما با موفیقت درست شد"]);
    }
    public function edit(Page $page)
    {
        return view("admin.content.page.edit" ,  compact("page"));
    }
    public function update(Page $page , PageRequest $pageRequest)
    {
        $inputs = $pageRequest->all();
        $page->update($inputs);
        $page->save();
        return redirect()->route("admin.content.page.index")->with(["success" => "صفحه شما با موفیقت بروز رسانی شد"]);
    }
}
