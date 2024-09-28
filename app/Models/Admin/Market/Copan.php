<?php

namespace App\Models\Admin\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Copan extends Model
{
    use HasFactory , SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }

    protected $fillable = ["code" , "amount" , "amount_type" ,"discount_ceiling" ,"type" ,"status" ,"start_date" ,"end_date" , "user_id"];
}
