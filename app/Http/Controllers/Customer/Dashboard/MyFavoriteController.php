<?php

namespace App\Http\Controllers\Customer\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyFavoriteController extends Controller
{
    public function myFavorite()
    {
        $user_favorites = auth()->user()->favorites;
        return view("customer.dashboard.my-favorites" , compact("user_favorites"));
    }
}
