<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    public function index()
    {
        return view("admin.ticket.admin.index");
    }
}
