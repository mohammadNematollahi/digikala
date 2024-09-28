<?php

namespace App\Http\Controllers\Admin\Notify\Email;

use Illuminate\Http\Request;
use App\Models\Admin\Notify\Email;
use App\Http\Controllers\Controller;
use App\Http\Services\File\UploadFile;
use App\Http\Requests\Admin\Notify\EmailRequest;

class EmailController extends Controller
{
    public function index()
    {
        return view("admin.notify.email.index");
    }

    public function create()
    {
        return view("admin.notify.email.create");
    }
    public function store(EmailRequest $emailRequest)
    {
        $inputs = $emailRequest->all();
        $published_at = (int)substr($inputs["published_at"] , 0 , -3);
        $date = date("Y-m-d H:m:s" , $published_at);
        $inputs["published_at"] = $date;
        Email::create($inputs);
        return redirect()->route("admin.notify.email.index")->with(["success" => "ایمیل شما به موفقیت ثبت شد"]);
    }

    public function edit(Email $email)
    {
        return view("admin.notify.email.edit" , compact("email"));
    }

    public function update(Email $email , EmailRequest $emailRequest)
    {
        $inputs = $emailRequest->all();
        $published_at = (int)substr($inputs["published_at"] , 0 , -3);
        $date = date("Y-m-d H:m:s" , $published_at);
        $inputs["published_at"] = $date;
        $email->update($inputs);
        $email->save();
        return redirect()->route("admin.notify.email.index")->with(["success" => "ایمیل شما به موفقیت بروز رسانی شد"]);
    }
}
