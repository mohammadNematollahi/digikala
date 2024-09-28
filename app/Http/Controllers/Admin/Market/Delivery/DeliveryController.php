<?php

namespace App\Http\Controllers\Admin\Market\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeliveryRequest;
use App\Models\Admin\Market\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        return view("admin.market.delivery.index");
    }

    public function create()
    {
        return view("admin.market.delivery.create");
    }

    public function store(DeliveryRequest $request)
    {
        $inputs = $request->all();
        Delivery::create($inputs);
        return redirect()->route("admin.market.delivery.index")->with(["success" => "نوع تحویل شما به درستی ثبت شد"]);
    }

    public function edit(Delivery $delivery)
    {
        return view("admin.market.delivery.edit" , compact("delivery"));
    }

    public function update( DeliveryRequest $request , Delivery $delivery)
    {
        $inputs = $request->all();
        $delivery->update($inputs);
        $delivery->save();
        return redirect()->route("admin.market.delivery.index")->with(["success" => "نوع تحویل شما به درستی بروز رسانی شد"]);
    }
}
