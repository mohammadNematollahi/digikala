<?php

namespace App\Http\Controllers\Admin\User\Permission;

use App\Models\Admin\User\Permission;
use App\Models\Admin\User\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\PermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        return view("admin.user.permission.index");
    }

    public function create()
    {
        return view("admin.user.permission.create");
    }

    public function store(PermissionRequest $request)
    {
        $inputs = $request->all();
        Permission::create($inputs);
        return redirect()->route("admin.user.permissions.index");
    }

    public function edit(Permission $permission)
    {
        return view("admin.user.permission.edit" , compact("permission"));
    }

    public function update(PermissionRequest $request , Permission $permission)
    {
        $inputs = $request->all();
        $permission->update($inputs);
        return redirect()->route("admin.user.permissions.index")->with(["success" => "بروز رسانی به درستی انجام شد"]);
    }
}
