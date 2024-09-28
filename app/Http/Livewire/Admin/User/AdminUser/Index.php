<?php

namespace App\Http\Livewire\Admin\User\AdminUser;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ["destroy"];
    public function render()
    {
        $admins = User::where("user_type" , 1)->get();
        return view('livewire.admin.user.admin-user.index' , compact("admins"));
    }

    public function status(User $user)
    {
        $status = $user->status == 0 ? 1 : 0;
        $user->update(["status" => $status]);
        $user->save();
    }

    public function destroy(User $user)
    {
        $user->delete();
        $user->save();
    }
}
