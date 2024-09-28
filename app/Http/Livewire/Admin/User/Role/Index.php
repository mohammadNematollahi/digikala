<?php

namespace App\Http\Livewire\Admin\User\Role;

use Livewire\Component;
use App\Models\Admin\User\Role;

class Index extends Component
{

    protected $listeners = ['destroy'];
    public function render()
    {
        $roles = Role::with(["permissions"])->latest()->get();
        return view('livewire.admin.user.role.index' , compact("roles"));
    }
    public function status(Role $role)
    {
        $status = $role->status == 0 ? 1 : 0;
        $role->update(["status" => $status]);
        $role->save();
    }
    public function destroy(Role $role)
    {
        $role->delete();
        $role->save();
    }
}
