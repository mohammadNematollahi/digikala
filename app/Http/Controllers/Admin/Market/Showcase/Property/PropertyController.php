<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\PropertyRequest;
use App\Models\Admin\Market\CategoryAttribute;
use App\Models\Admin\Market\ProductCategory;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view("admin.market.showcase.property.index");
    }

    public function create()
    {
        $categories = ProductCategory::where("status" , 1)->get();
        return view("admin.market.showcase.property.create" , compact("categories"));
    }

    public function store(PropertyRequest $request)
    {
        $inputs = $request->all();
        CategoryAttribute::create($inputs);
        return redirect()->route("admin.market.showcase.property.index")->with(["success" => "فرم کالا با موفقیت ثبت شد"]);
    }

    public function edit(CategoryAttribute $attribute)
    {
        $categories = ProductCategory::where("status" , 1)->get();
        return view("admin.market.showcase.property.edit" , compact("attribute" , "categories"));
    }

    public function update(CategoryAttribute $attribute , PropertyRequest $request)
    {
        $inputs = $request->all();
        $attribute->update($inputs);
        return redirect()->route("admin.market.showcase.property.index")->with(["success" => "فرم کالا با موفقیت بروز رسانی شد"]);
    }
}
