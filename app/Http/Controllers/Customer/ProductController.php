<?php

namespace App\Http\Controllers\Customer;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Admin\Comment;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Content\CommentRequest;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $user = auth()->user()->id;

        $cart = CartItem::where(function ($query) use ($product , $user) {
            $query->where("user_id", $user)->where("product_id", $product->id);
        })->first();
        
        $product_same = Product::where("category_id" , $product->category_id)->latest()->limit(10)->get();
        return view("customer.product" , compact("product" , "product_same" , "cart"));
    }

    public function addComment(CommentRequest $request , Product $product)
    {
        $inputs = $request->all();
        $inputs["author_id"] = auth()->user()->id;
        $inputs["commentable_id"] = $product->id;
        $inputs["commentable_type"] = Product::class;

        Comment::create($inputs);
        return back()->with(["success" => "کامنت شما بعد تایید انتشار پیدا میکند"]);
    }

    public function addToFavorite(Product $product)
    {
        if(!Auth::check()){
            $this->dispatchBrowserEvent('show-login-toast');
            return response()->json(["status" => "error"]);
        }

        if(auth()->user()->favorites()->find($product->id) == null){
            
            $product->favorites()->attach(["user_id" => auth()->user()->id]);
            return response()->json(["status" => "1"]);

        }else{

            $product->favorites()->detach(["user_id" => auth()->user()->id]);
            return response()->json(["status" => "0"]);
            
        }
    }
}
