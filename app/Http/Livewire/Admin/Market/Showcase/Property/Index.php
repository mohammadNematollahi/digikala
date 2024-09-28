<?php

namespace App\Http\Livewire\Admin\Market\Showcase\Property;

use App\Models\Admin\Market\CategoryAttribute;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ["destroy"];
    public function render()
    {
        $attributes = CategoryAttribute::latest()->get();
        return view('livewire.admin.market.showcase.property.index' , compact("attributes"));
    }

    public function destroy(CategoryAttribute $attribute)
    {
        $attribute->delete();
    }
}
