<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryRequest;
use App\Models\Admin\Ticket\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index()
    {
        return view("admin.ticket.category.index");
    }

    public function create()
    {
        return view("admin.ticket.category.create");
    }

    public function store(TicketCategoryRequest $request)
    {
        TicketCategory::create($request->all());
        return redirect()->route("admin.ticket.category.index")->with(["success" => "دسته بندی شما به درستی ثبت گردید"]);
    }

    public function edit(TicketCategory $ticketCategory)
    {
        return view("admin.ticket.category.edit" , compact("ticketCategory"));
    } 
    
    public function update(TicketCategory $ticketCategory , TicketCategoryRequest $request)
    {
        $ticketCategory->update($request->all());
        $ticketCategory->save();
        
        return redirect()->route("admin.ticket.category.index")->with(["success" => "دسته بندی شما به درستی بروز رسانی شد"]);
    }
}
