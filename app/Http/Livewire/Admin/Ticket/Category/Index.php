<?php

namespace App\Http\Livewire\Admin\Ticket\Category;

use App\Models\Admin\Ticket\TicketCategory;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['destroy'];
    public function render()
    {
        $categories = TicketCategory::latest()->get();
        return view('livewire.admin.ticket.category.index' , compact("categories"));
    }

    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();
        $ticketCategory->save();
    }
    public function status(TicketCategory $ticketCategory)
    {
        $status = $ticketCategory->status == 0 ? 1 : 0;
        $ticketCategory->update(["status" => $status]);
        $ticketCategory->save();
    }
}
