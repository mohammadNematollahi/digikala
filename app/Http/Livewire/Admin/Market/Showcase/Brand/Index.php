<?php

namespace App\Http\Livewire\Admin\Market\Showcase\Brand;

use App\Models\Admin\Market\Brand;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];

    public function render()
    {
        $brands = Brand::latest()->get();
        return view('livewire.admin.market.showcase.brand.index' , compact("brands"));
    }
    public function status(Brand $brand)
    {
        $status = $brand->status == 0 ? 1 : 0;
        $brand->update(["status" => $status]);
        $brand->save();
    }
    
    public function destroy(Brand $brand)
    {
        $brand->delete();
        $brand->save();
    }

}
