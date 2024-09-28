<?php

namespace App\Http\Livewire\Admin\Ticket\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Ticket\TicketAdmin;

class Index extends Component
{

    protected $listeners = ['destroy'];

    public function render()
    {
        $admins = User::where("user_type" , 1)->get();
        return view('livewire.admin.ticket.admin.index' , compact("admins"));
    }

    public function setAndUnset(User $user)
    {
        if($user->ticketAdmin != null)
        {
            $user->ticketAdmin()->delete();
        }else{
            $user->ticketAdmin()->create(["user_id" => $user->id]);
        }
    }
}
