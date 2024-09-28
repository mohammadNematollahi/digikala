<?php

namespace App\Models\Admin\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory , SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class , "category_id" , "id");
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class , "priority_id" , "id");
    }

    public function ticketAdmin()
    {
        return $this->belongsTo(TicketAdmin::class , "reference_id" , "id");
    }

    protected $fillable = ["seen" , "status" ,"subject" ,"description" ,"reference_id" ,"user_id" ,"category_id" ,"priority_id" ,"ticket_id"];
}
