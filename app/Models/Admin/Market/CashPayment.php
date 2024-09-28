<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashPayment extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["amount" , "cash_receiver" , "pay_date" , "user_id"];
    protected $guarded = ["id" , "user_id"];
}
