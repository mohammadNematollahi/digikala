<?php

namespace App\Http\Livewire\Admin\Content\Menu;

use App\Models\Admin\Content\Menu;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];
    public function render()
    {
        $menus = Menu::latest()->get();
        return view('livewire.admin.content.menu.index' , compact("menus"));
    }

    public function status(Menu $menu)
    {
        $status = $menu->status == 0 ? 1 : 0;
        $menu->update(["status" => $status]);
        $menu->save();
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        $menu->save();
    }
}
