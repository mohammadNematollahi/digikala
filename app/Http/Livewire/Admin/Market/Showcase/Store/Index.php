<?php

namespace App\Http\Livewire\Admin\Market\Showcase\Store;

use App\Models\Admin\Market\Product;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $products = Product::latest()->get();
        return view('livewire.admin.market.showcase.store.index' ,compact("products"));
    }
}
