<?php

namespace App\Http\Livewire\Admin\Content\Page;

use App\Models\Admin\Content\Page;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];
    public function render()
    {
        $pages = Page::latest()->get();
        return view('livewire.admin.content.page.index', compact("pages"));
    }

    public function status(Page $Page)
    {
        $status = $Page->status == 0 ? 1 : 0;
        $Page->update(["status" => $status]);
        $Page->save();
    }

    public function destroy(Page $Page)
    {
        $Page->delete();
        $Page->save();
    }
}
