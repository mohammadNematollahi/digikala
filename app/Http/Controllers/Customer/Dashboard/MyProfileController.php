<?php

namespace App\Http\Controllers\Customer\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\MyProfileRequest;

class MyProfileController extends Controller
{

    public function myProfile()
    {
        $user = auth()->user();
        return view("customer.dashboard.my-profile" , compact("user"));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view("customer.dashboard.edit-profile" , compact("user"));
    }

    public function updateProfile(MyProfileRequest $request)
    {
        auth()->user()->update($request->all());
        return redirect()->route("profile.my-profile");
    }
}
