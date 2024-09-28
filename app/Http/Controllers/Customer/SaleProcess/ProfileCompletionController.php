<?php

namespace App\Http\Controllers\Customer\SaleProcess;

use App\Models\CartItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ProfileCompletionRequest;

class ProfileCompletionController extends Controller
{
    public function profileCompletion()
    {
        $carts = CartItem::where("user_id" , auth()->user()->id)->get();
        return view("customer.sale-process.profile-completion", compact("carts"));
    }

    public function profileUpdate(ProfileCompletionRequest $request)
    {
        $inputs = $request->all();

        auth()->user()->update($inputs);

        return redirect()->route("customer.address-delivery");
    }
}
