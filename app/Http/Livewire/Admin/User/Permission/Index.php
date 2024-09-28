<?php

namespace App\Http\Livewire\Admin\User\Permission;

use App\Models\Admin\User\Permission;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $permissions = Permission::latest()->get();
        return view('livewire.admin.user.permission.index' , compact("permissions"));
    }

    public function status(Permission $permission)
    {
        $status = $permission->status == 0 ? 1 : 0;
        $permission->update(["status" => $status]);
    }
}
