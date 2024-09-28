<?php

namespace App\Http\Controllers\Admin\Content\FAQ;

use Illuminate\Http\Request;
use App\Models\Admin\Content\FAQ;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FAQRequest;

class FAQController extends Controller
{
    public function index()
    {
        return view("admin.content.faq.index");
    }

    public function create()
    {
        return view("admin.content.faq.create");
    }

    public function store(FAQRequest $fAQRequest)
    {
        $inputs = $fAQRequest->all();
        FAQ::create($inputs);
        return redirect()->route("admin.content.faq.index")->with(["success" => "پرسش و پاسخ شما به درستی ذخیره شد"]);
    }

    public function edit(FAQ $fAQ)
    {
        return view("admin.content.faq.edit" , compact("fAQ"));
    }

    public function update(FAQ $fAQ , FAQRequest $fAQRequest)
    {
        $inputs = $fAQRequest->all();
        $fAQ->update($inputs);
        $fAQ->save();
        return redirect()->route("admin.content.faq.index")->with(["success" => "بروز رسانی با موفقیت انجام شد"]);
    }
}
