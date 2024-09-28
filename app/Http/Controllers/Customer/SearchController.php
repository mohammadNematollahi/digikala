<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Brand;
use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\ProductCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, ProductCategory $category = null)
    {
        $search = $request->get("q");
        $sort = $request->get("sort");
        $brands = $request->get("brands");
        $low_price = $request->get("l_price");
        $height_price = $request->get("h_price");


        $products = Product::when($search, function ($query) use ($search) {
            return $query->where("name", "like", "%" . $search . "%");
        })
            ->when($category, function ($query) use ($category) {
                return $query->where("category_id", $category->id);
            })
            ->when(![$category, $search], function ($query) {
                return $query;
            })
            ->when($brands, function ($query) use ($brands) {
                return $query->whereIn("brand_id", $brands);
            });

        switch ($sort) {
            case 1:
                $products->latest();
                break;
            case 2:
                $products->latest();
                break;
            case 3:
                $products->orderBy("price", "desc");
                break;
            case 4:
                $products->orderBy("price");
                break;
            case 5:
                $products->orderBy("view", "desc");
                break;
        }

        $products = $low_price && $height_price ? $products->whereBetween("price", [$low_price, $height_price]) :
            $products->when($low_price, function ($query) use ($low_price) {
                return $query->where("price", "<=", $low_price);
            })->when($height_price, function ($query) use ($height_price) {
                return $query->where("price", ">=", $height_price);
            });

        $products = $products->paginate(15)->appends(["q" => $search, "sort" => $sort, "brands" => $brands]);

        $brands = Brand::where("status", 1)->get();

        return view("customer.filter", compact("products", "category", "brands"));
    }

    public function ajaxSearch(Request $request)
    {

        $search = $request->get("search");
        $products = null;

        if ($search != null) {
            $products = Product::where("name", 'like', "%$search%")->with("category", function ($query) {
                $query->select("id", "name", "slug");
            })->limit(10)->get(["id", "name", "category_id"]);

            $products->each(function ($product) use ($search) {
                $product->url = route("customer.search", ["category" => $product->category->slug, "q" => $search]);
            });
        }

        return response()->json(
            $products
        );

    }
}
