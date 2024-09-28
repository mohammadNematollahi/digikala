<?php

namespace App\Http\Controllers\Admin\Content\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Admin\Content\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view("admin.content.menu.index");
    }

    public function create()
    {
        $parent_menus = Menu::whereNull("parent_id")->get(); 
        return view("admin.content.menu.create" , compact("parent_menus"));
    }

    public function edit(Menu $menu)
    {
        $parent_menus = Menu::whereNull("parent_id")->get(); 
        return view("admin.content.menu.edit" , compact("parent_menus" , "menu"));
    }

    public function store(MenuRequest $menuRequest)
    {
        $inputs = $menuRequest->all();
        Menu::create($inputs);
        return redirect()->route("admin.content.menu.index")->with(["success" => "ایجاد منو با موفقیت انجام شد"]);
    }

    public function update(MenuRequest $menuRequest , Menu $menu)
    {
        $inputs = $menuRequest->all();
        $menu->update($inputs);
        $menu->save();
        return redirect()->route("admin.content.menu.index")->with(["success" => "منوی شما با موفقیت بروز رسانی شد"]);
    }
}
