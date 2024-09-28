<?php

namespace App\Http\Livewire\Admin\User\Customer;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];
    public function render()
    {
        $customers = User::where("user_type" , 0)->get();
        return view('livewire.admin.user.customer.index' , compact("customers"));
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
