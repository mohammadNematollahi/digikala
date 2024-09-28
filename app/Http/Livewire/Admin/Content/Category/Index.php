<?php

namespace App\Http\Livewire\Admin\Content\Category;

use Livewire\Component;
use App\Models\Admin\Content\PostCategory;

class Index extends Component
{
    protected $listeners = ['destroy'];
    public function render()
    {
        $categories = PostCategory::latest()->get();
        return view('livewire.admin.content.category.index' , compact("categories"));
    }
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        $postCategory->save();
    }
    public function status(PostCategory $postCategory)
    {
        $status = $postCategory->status == 0 ? 1 : 0;
        $postCategory->update(["status" => $status]);
        $postCategory->save();
    }
}
