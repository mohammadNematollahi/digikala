<?php

namespace App\Http\Controllers\Admin\User\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\Admin\User\Permission;
use App\Models\Admin\User\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view("admin.user.role.index");
    }

    public function create()
    {
        $permissions =  Permission::all();
        return view("admin.user.role.create" , compact("permissions"));
    }

    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $permissions = [];
        foreach($inputs["permission_id"] as $key => $value){
            array_push($permissions , $key);
        }
        $role = new Role();
        $role->name = $inputs["name"];
        $role->description = $inputs["description"];
        $role->save();
        $role->permissions()->attach($permissions);
        return redirect()->route("admin.user.role.index")->with(["success" => "نقش های شما به درستی ثبت شد"]);
    }

    public function edit(Role $role)
    {
        return view("admin.user.role.edit" , compact("role"));
    }

    public function update(RoleRequest $request , Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        $role->save();
        return redirect()->route("admin.user.role.index")->with(["success" => "بروز رسانی به درستی انجام شد"]);
    }

    public function permissionEdit(Role $role)
    {
        $permissionsId = [];

        foreach($role->permissions as $item){
            array_push($permissionsId , $item->id);
        }

        $permissions =  Permission::all();
        return view("admin.user.role.permission-edit" , compact("permissions" , "role" , "permissionsId"));
    }

    public function permissionUpdate(Role $role , RoleRequest $request)
    {
        $inputs = $request->all();
        $permissions = [];
        foreach($inputs["permission_id"] as $key => $value){
            array_push($permissions , $key);
        }
        $role->permissions()->sync($permissions);
        return redirect()->route("admin.user.role.index")->with(["success" => "دسترسی ها با موفقیت بروز رسانی شد"]);
    }
}
