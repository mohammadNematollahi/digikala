<?php

namespace App\Models\Admin\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketAdmin extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }
    protected $fillable = ["user_id"];
}