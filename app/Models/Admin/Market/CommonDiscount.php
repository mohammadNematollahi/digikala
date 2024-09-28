<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommonDiscount extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "common_discount";
    protected $fillable = ["title" , "percentage" , "discount_ceiling" , "end_date" ,"start_date" , "status" , "minimal_order_amount"];
}
