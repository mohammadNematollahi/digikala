<?php

namespace App\Models\Admin\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OfflinePayment extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["amount" , "transaction_id" , "pay_date" , "user_id"];
    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }
}