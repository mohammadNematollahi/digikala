<?php

namespace App\Http\Controllers\Admin\Market\Discount\AmazingSale;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Models\Admin\Market\AmazingSale;
use App\Models\Admin\Market\Product;
use Illuminate\Http\Request;

class AmazingSaleController extends Controller
{
    public function index()
    {
        return view("admin.market.discount.amazing-sale.index");
    }

    public function create()
    {
        $products = Product::all();
        return view("admin.market.discount.amazing-sale.create" , compact("products"));
    }

    public function store(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $start_date = (int)substr($inputs["start_date"] , 0 , -3);
        $start_date = date("Y-m-d H:m:s" , $start_date);

        $end_date = (int)substr($inputs["end_date"] , 0 , -3);
        $end_date = date("Y-m-d H:m:s" , $end_date);

        $inputs["start_date"] = $start_date ;
        $inputs["end_date"] = $end_date;

        AmazingSale::create($inputs);
        return redirect()->route("admin.market.discount.amazing-sale.index")->with(["success" => "فروش ویژه شما موفقیت ثبت شد"]);
    }


    public function edit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view("admin.market.discount.amazing-sale.edit" , compact("amazingSale" , "products"));
    }

    public function update(AmazingSale $amazingSale , AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $start_date = (int)substr($inputs["start_date"] , 0 , -3);
        $start_date = date("Y-m-d H:m:s" , $start_date);

        $end_date = (int)substr($inputs["end_date"] , 0 , -3);
        $end_date = date("Y-m-d H:m:s" , $end_date);

        $inputs["start_date"] = $start_date ;
        $inputs["end_date"] = $end_date;

        $amazingSale->update($inputs);
        return redirect()->route("admin.market.discount.amazing-sale.index")->with(["success" => "فروش ویژه شما موفقیت بروز رسانی شد"]);
    }
}
