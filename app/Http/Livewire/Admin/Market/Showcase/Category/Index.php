<?php

namespace App\Http\Livewire\Admin\Market\Showcase\Category;

use App\Models\Admin\Market\ProductCategory;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];
    public function render()
    {
        $categories = ProductCategory::latest()->get();
        return view('livewire.admin.market.showcase.category.index' , compact("categories"));
    }

    public function status(ProductCategory $productCategory)
    {
        $status = $productCategory->status == 0 ? 1 : 0;
        $productCategory->update(["status" => $status]);
        $productCategory->save();
    }

    public function showInMenu(ProductCategory $productCategory)
    {
        $show_in_menu = $productCategory->show_in_menu == 0 ? 1 : 0;
        $productCategory->update(["show_in_menu" => $show_in_menu]);
        $productCategory->save();
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        $productCategory->save();
    }
}
