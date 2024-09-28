<?php

namespace App\Models\Admin\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlinePayment extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = ["id"];
    protected $casts = ["bank_first_response" => "array" , "bank_second_response" => "array"];
    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }
}
