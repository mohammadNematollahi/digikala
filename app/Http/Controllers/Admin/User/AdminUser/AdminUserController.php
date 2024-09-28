<?php

namespace App\Http\Controllers\Admin\User\AdminUser;

use App\Models\Admin\User\Permission;
use App\Models\User;
use App\Models\Notification;
use App\Models\Admin\User\Role;
use Illuminate\Http\Client\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\RoleUserRequest;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Requests\Admin\User\PermissionUserRequest;

class AdminUserController extends Controller
{
    public function index()
    {
        return view("admin.user.admin-user.index");
    }

    public function create()
    {
        return view("admin.user.admin-user.create");
    }
    public function store(AdminUserRequest $request)
    {
        $inputs = $request->all();

        if($request->file("avatar")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . "avatar");
            $response = ImageService::resizeAndSave($request->file("avatar") , 300 , 150);
            $inputs["avatar"] = $response;
        }

        $password = Hash::make($inputs["password"] , ["rounds" => 15]);
        $inputs["password"] = $password;
        $inputs["user_type"] = 1;

        User::create($inputs);
        return redirect()->route("admin.user.customer.index")->with(["success" => "کاربر ادمین شما با موفقیت بر روی سیستم ثبت شد"]);
    }

    public function edit(User $user)
    {
        return view("admin.user.admin-user.edit" , compact("user"));
    }

    public function update(User $user , AdminUserRequest $request)
    {
        $inputs = $request->all();

        if($request->file("avatar")){
            ImageService::setExclusiveDirectory("img" . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "users" . DIRECTORY_SEPARATOR . "avatar");
            $response = ImageService::resizeAndSave($request->file("avatar") , 300 , 150);
            $inputs["avatar"] = $response;
            ImageService::deleteImage($user->avatar);
        }

        if($inputs["password"] != null)
        {
            $password = Hash::make($inputs["password"] , ["rounds" => 15]);
            $inputs["password"] = $password;
        }else{
            unset($inputs["password"]);
        }
    
        $user->update($inputs);
        $user->save();
        return redirect()->route("admin.user.admin-user.index")->with(["success" => "کاربر ادمین شما با موفقیت بروز رسانی شد"]);
    }

    public function roleUser(User $user)
    {
        $roles = Role::where("status" , 1)->get();
        return view("admin.user.admin-user.role-user" , compact("user" , "roles"));

    }

    public function roleUserStore(RoleUserRequest $request , User $user)
    {
        $roles = $request->input("role_id");
        $user->roles()->sync($roles);
        return redirect()->route("admin.user.admin-user.index")->with(["success" => "نقش های کار بر به درستی ذخیره شد"]);
    }

    public function permissionUser(User $user)
    {
        $permissions = Permission::where("status" , 1)->get();
        return view("admin.user.admin-user.permission-user" , compact("user" , "permissions"));
    }
    public function permissionUserStore(PermissionUserRequest $request , User $user)
    {
        $permission = $request->input("permission_id");
        $user->permissions()->sync($permission);
        return redirect()->route("admin.user.admin-user.index")->with(["success" => "دسترسی های کار بر به درستی ذخیره شد"]);
    }
}
