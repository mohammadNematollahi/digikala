<?php

namespace App\Http\Controllers\Admin\Notify\SMS;

use Illuminate\Http\Request;
use App\Models\Admin\Notify\SMS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notify\SMSRequest;

class SMSController extends Controller
{
    public function index()
    {
        return view("admin.notify.sms.index");
    }

    public function create()
    {
        return view("admin.notify.sms.create");
    }

    public function store(SMSRequest $sMSRequest)
    {
        $inputs = $sMSRequest->all();
        $published_at = (int)substr($inputs["published_at"] , 0 , -3);
        $date = date("Y-m-d H:m:s" , $published_at);
        $inputs["published_at"] = $date;
        SMS::create($inputs);
        return redirect()->route("admin.notify.sms.index")->with(["success" => "پیام شما به موفقیت ثبت شد"]);
    }

    public function edit(SMS $SMS)
    {
        return view("admin.notify.sms.edit" , compact("SMS"));
    }

    public function update(SMS $SMS , SMSRequest $sMSRequest)
    {
        $inputs = $sMSRequest->all();
        $published_at = (int)substr($inputs["published_at"] , 0 , -3);
        $date = date("Y-m-d H:m:s" , $published_at);
        $inputs["published_at"] = $date;
        $SMS->update($inputs);
        $SMS->save();
        return redirect()->route("admin.notify.sms.index")->with(["success" => "پیام شما به موفقیت بروز رسانی شد"]);
    }
}
