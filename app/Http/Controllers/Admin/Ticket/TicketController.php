<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketRequest;
use App\Models\Admin\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show(Ticket $ticket)
    {
        $ticket->seen = 1;
        $ticket->save();
        return view("admin.ticket.show" , compact("ticket"));
    }
    public function newTickets()
    {
        return view("admin.ticket.index");
    }
    public function openTickets()
    {
        return view("admin.ticket.index");
    }
    public function closeTickets()
    {
        return view("admin.ticket.index");
    }

    public function response(Ticket $ticket , TicketRequest $ticketRequest)
    {
        $inputs = $ticketRequest->all();
        $inputs["description"] = $inputs["response"];
        $inputs["subject"] = $ticket->subject;
        $inputs["ticket_id"] = $ticket->id;
        $inputs["category_id"] = $ticket->category_id;
        $inputs["priority_id"] = $ticket->priority_id;
        $inputs["reference_id"] = $ticket->reference_id;
        $inputs["user_id"] = $ticket->user_id;
        $inputs["status"] = 1;
        $inputs["seen"] = 1;

        Ticket::create($inputs);
        return redirect()->route("admin.ticket.new-tickets")->with(["success" => "پاسخ شما به درستی ثبت شد"]);
    }
}
