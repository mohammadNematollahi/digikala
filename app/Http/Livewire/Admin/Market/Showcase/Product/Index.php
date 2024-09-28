<?php

namespace App\Http\Livewire\Admin\Market\Showcase\Product;

use App\Models\Admin\Market\Product;
use Livewire\Component;

class Index extends Component
{

    protected $listeners = ['destroy'];

    public function render()
    {
        $products = Product::latest()->get();
        return view('livewire.admin.market.showcase.product.index' , compact("products"));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $product->save();
    }
}
