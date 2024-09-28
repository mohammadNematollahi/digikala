<?php

namespace App\Http\Controllers\Admin\User\Customer;

use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\CustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        return view("admin.user.customer.index");
    }

    public function create()
    {
        return view("admin.user.customer.create");
    }

    public function store(CustomerRequest $request)
    {
        $inputs = $request->all();

        if($request->file("avatar")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . "avatar");
            $response = ImageService::resizeAndSave($request->file("avatar") , 300 , 150);
            $inputs["avatar"] = $response;
        }

        $password = Hash::make($inputs["password"] , ["rounds" => 15]);
        $inputs["password"] = $password;
        $inputs["user_type"] = 0;

        
        User::create($inputs);

        $user = User::first();
        $user->notify(new UserNotification("یک کاربر اضاف شد"));

        return redirect()->route("admin.user.admin-user.index")->with(["success" => "کاربر شما با موفقیت بر روی سیستم ثبت شد"]);
    }

    public function edit(User $user)
    {
        return view("admin.user.customer.edit" , compact("user"));
    }

    public function update(User $user , CustomerRequest $request)
    {
        $inputs = $request->all();

        if($request->file("avatar")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . "avatar");
            $response = ImageService::resizeAndSave($request->file("avatar") , 300 , 150);
            $inputs["avatar"] = $response;
            ImageService::deleteImage($user->avatar);
        }

        if($request->input("password") != null)
        {
            $password = Hash::make($inputs["password"] , ["rounds" => 15]);
            $inputs["password"] = $password;
        }
    
        $user->update($inputs);
        $user->save();
        return redirect()->route("admin.user.admin-user.index")->with(["success" => "کاربر شما با موفقیت بروز رسانی شد"]);
    }
}
