<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\Admin\Market\Brand;
use App\Models\Admin\Market\Banner;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function home()
    {
        Auth::loginUsingId(3);

        $banner_top_big = Cache::remember("banner_top_big", 5, function () {
            return Banner::where('position', 0)->where("status", 1)->limit(5)->get();
        });
        $banner_top_small_first = Cache::remember("banner_top_small_first", 5, function () {
            return Banner::where('position', 1)->where("status", 1)->first();
        });
        $banner_top_small_second = Cache::remember("banner_top_small_second", 5, function () {
            return Banner::where('position', 2)->where("status", 1)->first();
        });
        $banner_middle_right = Cache::remember("banner_middle_right", 5, function () {
            return Banner::where('position', 3)->where("status", 1)->first();
        });
        $banner_middle_left = Cache::remember("banner_middle_left", 5, function () {
            return Banner::where('position', 4)->where("status", 1)->first();
        });
        $banner_button = Cache::remember("banner_button", 5, function () {
            return Banner::where('position', 5)->where("status", 1)->first();
        });
        $last_products = Cache::remember("last_products", 5, function () {
            return Product::latest()->get();
        });
        $products = Cache::remember("products", 5, function () {
            return Product::all();
        });
        $brands = Cache::remember("brands", 5, function () {
            return Brand::where("status", 1)->get();
        });

        return view('customer.home', compact("banner_top_big", "banner_top_small_first", "banner_top_small_second", "banner_middle_right", "banner_middle_left", "banner_button", "products", "brands", "last_products"));
    }
}
