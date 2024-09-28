<?php

namespace App\Http\Controllers\Admin\Market\Discount\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CommonDiscountReqeust;
use App\Models\Admin\Market\CommonDiscount;

class CommonController extends Controller
{
    public function index()
    {
        return view("admin.market.discount.common.index");
    }

    public function create()
    {
        return view("admin.market.discount.common.create");
    }

    public function store(CommonDiscountReqeust $request)
    {
        $inputs = $request->all();
        $start_date = (int)substr($inputs["start_date"] , 0 , -3);
        $start_date = date("Y-m-d H:m:s" , $start_date);

        $end_date = (int)substr($inputs["end_date"] , 0 , -3);
        $end_date = date("Y-m-d H:m:s" , $end_date);

        $inputs["start_date"] = $start_date ;
        $inputs["end_date"] = $end_date;

        CommonDiscount::create($inputs);
        return redirect()->route("admin.market.discount.common.index")->with(["success" => "تخفیف عمومی شما برو روی محصولات با موفقیت ثبت شد"]);
    }

    public function edit(CommonDiscount $commonDiscount)
    {
        return view("admin.market.discount.common.edit" , compact("commonDiscount"));
    }

    public function update(CommonDiscount $commonDiscount , CommonDiscountReqeust $request)
    {
        $inputs = $request->all();
        $start_date = (int)substr($inputs["start_date"] , 0 , -3);
        $start_date = date("Y-m-d H:m:s" , $start_date);

        $end_date = (int)substr($inputs["end_date"] , 0 , -3);
        $end_date = date("Y-m-d H:m:s" , $end_date);

        $inputs["start_date"] = $start_date ;
        $inputs["end_date"] = $end_date;

        $commonDiscount->update($inputs);
        return redirect()->route("admin.market.discount.common.index")->with(["success" => "تخفیف عمومی شما برو روی محصولات با موفقیت بروز رسانی شد"]);
    }
}
