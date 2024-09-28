<?php

namespace App\Http\Controllers\Admin\Market\Discount\Copan;

use App\Models\Admin\Market\Copan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CopanReqeust;
use App\Http\Requests\Admin\Market\CopanRequest;

class CopanController extends Controller
{
    public function index()
    {
        return view("admin.market.discount.copan.index");
    }

    public function create()
    {
        $users = User::all();
        return view("admin.market.discount.copan.create" , compact("users"));
    }

    public function store(CopanRequest $request)
    {
        $inputs = $request->all();
        $start_date = (int)substr($inputs["start_date"] , 0 , -3);
        $start_date = date("Y-m-d H:m:s" , $start_date);

        $end_date = (int)substr($inputs["end_date"] , 0 , -3);
        $end_date = date("Y-m-d H:m:s" , $end_date);

        $inputs["start_date"] = $start_date ;
        $inputs["end_date"] = $end_date;

        Copan::create($inputs);
        return redirect()->route("admin.market.discount.copan.index")->with(["success" => "کپن شما با موفقیت ثبت شد"]);
    }

    public function edit(Copan $copan)
    {
        $users = User::all();
        return view("admin.market.discount.copan.edit" , compact("users" , "copan"));
    }

    public function update(Copan $copan , CopanRequest $request)
    {
        $inputs = $request->all();
        $start_date = (int)substr($inputs["start_date"] , 0 , -3);
        $start_date = date("Y-m-d H:m:s" , $start_date);

        $end_date = (int)substr($inputs["end_date"] , 0 , -3);
        $end_date = date("Y-m-d H:m:s" , $end_date);

        $inputs["start_date"] = $start_date ;
        $inputs["end_date"] = $end_date;

        $copan->update($inputs);
        return redirect()->route("admin.market.discount.copan.index")->with(["success" => "کپن شما با موفقیت بروز رسانی شد"]);
    }

}
