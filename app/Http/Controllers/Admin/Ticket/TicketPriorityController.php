<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketPriorityRequest;
use App\Models\Admin\Ticket\TicketPriority;
use Illuminate\Http\Request;

class TicketPriorityController extends Controller
{
    public function index()
    {
        return view("admin.ticket.priority.index");
    }

    public function create()
    {
        return view("admin.ticket.priority.create");
    }

    public function store(TicketPriorityRequest $request)
    {
        TicketPriority::create($request->all());
        return redirect()->route("admin.ticket.priority.index")->with(["success" => "دسته بندی شما به درستی ثبت گردید"]);
    }

    public function edit(TicketPriority $ticketPriority)
    {
        return view("admin.ticket.priority.edit" , compact("ticketPriority"));
    } 
    
    public function update(TicketPriority $ticketPriority , TicketPriorityRequest $request)
    {
        $ticketPriority->update($request->all());
        $ticketPriority->save();
        
        return redirect()->route("admin.ticket.priority.index")->with(["success" => "دسته بندی شما به درستی بروز رسانی شد"]);
    }
}
