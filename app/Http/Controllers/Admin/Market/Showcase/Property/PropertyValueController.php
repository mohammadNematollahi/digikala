<?php

namespace App\Http\Controllers\Admin\Market\Showcase\Property;

use App\Models\Admin\Market\CategoryValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\CategoryAttribute;
use App\Http\Requests\Admin\Market\PropertyValueRequest;

class PropertyValueController extends Controller
{
    public function index(CategoryAttribute $attribute)
    {
        return view("admin.market.showcase.property.property-value.index" , compact("attribute"));
    }

    public function create(CategoryAttribute $attribute)
    {
        return view("admin.market.showcase.property.property-value.create" , compact("attribute"));
    }

    public function store(CategoryAttribute $attribute , PropertyValueRequest $request)
    {
        $inputs = $request->all();
        $value = [
            "value" => $inputs['value'],
            "price_increase" => $inputs["price_increase"]
        ];

        $inputs['value'] = $value;
        $inputs['category_attribute_id'] = $attribute->id;

        CategoryValue::create($inputs);

        return redirect()->route("admin.market.showcase.property.value.index" , $attribute->id)->with(["success" => "ویژگی شما با موفقیت بر روی کالا ثبت شد"]);
    }

    public function edit(CategoryValue $categoryValue)
    {
        return view("admin.market.showcase.property.property-value.edit" , compact("categoryValue"));
    }

    public function update(CategoryValue $categoryValue , PropertyValueRequest $request)
    {
        $inputs = $request->all();
        $value = [
            "value" => $inputs['value'],
            "price_increase" => $inputs["price_increase"]
        ];

        $inputs['value'] = $value;
        $inputs['category_attribute_id'] = $categoryValue->id;

        $categoryValue->update($inputs);

        return redirect()->route("admin.market.showcase.property.value.index" , $categoryValue->attribute->id)->with(["success" => "ویژگی شما با موفقیت بروز رسانی شد"]);
    }

    public function destroy(CategoryValue $categoryValue)
    {
        $categoryValue->delete();
        return redirect()->route("admin.market.showcase.property.value.index" , $categoryValue->attribute->id)->with(["success" => "مقدار شما با موفقیت حذف شد"]);
    }
}
