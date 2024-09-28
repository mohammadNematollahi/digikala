<?php

namespace App\Http\Livewire\Admin\Ticket\Priority;

use App\Models\Admin\Ticket\TicketPriority;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];

    public function render()
    {
        $priorities = TicketPriority::latest()->get();
        return view('livewire.admin.ticket.priority.index' , compact("priorities"));
    }

    public function destroy(TicketPriority $ticketPriority)
    {
        $ticketPriority->delete();
        $ticketPriority->save();
    }
    public function status(TicketPriority $ticketPriority)
    {
        $status = $ticketPriority->status == 0 ? 1 : 0;
        $ticketPriority->update(["status" => $status]);
        $ticketPriority->save();
    }
}
