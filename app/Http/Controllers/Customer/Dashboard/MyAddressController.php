<?php

namespace App\Http\Controllers\Customer\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Province;

class MyAddressController extends Controller
{
    public function myAddress()
    {
        $user_addresses = auth()->user()->addresses;
        $provinces = Province::get(["id" , "name"]);
        return view("customer.dashboard.my-address" , compact("user_addresses" ,  "provinces"));
    }
}
