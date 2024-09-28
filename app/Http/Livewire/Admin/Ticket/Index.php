<?php

namespace App\Http\Livewire\Admin\Ticket;

use Livewire\Component;
use App\Models\Admin\Ticket\Ticket;
use Illuminate\Support\Facades\Route;

class Index extends Component
{
    public $currentUrl;
    public function mount()
    {
        $this->currentUrl = Route::currentRouteName();
    }
    public function render()
    {
        $current_page = explode(".", $this->currentUrl)[2];
        $tickets = null;

        if ($current_page == "new-tickets") {

            $tickets = Ticket::where("seen" , 0)->orderBy("created_at" , "desc")->get();

        }
        else if($current_page == "close-tickets")
        {
            $tickets = Ticket::where("status" , 0)->orderBy("created_at" , "desc")->get();

        }
        else{
            $tickets = Ticket::where("status" , 1)->orderBy("created_at" , "desc")->get();

        }

        return view('livewire.admin.ticket.index', compact("tickets"));
    }

    public function ticketCloseAndOpen(Ticket $ticket)
    {
        $status = $ticket->status == 0 ? 1 : 0;
        $ticket->update(["status" => $status]);
        $ticket->save();
    }

}
