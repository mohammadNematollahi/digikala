<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingSale extends Model
{
    use HasFactory , SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class , "product_id" ,"id");
    }

    protected $fillable = ["product_id" , "percentage" , "end_date" , "start_date" ,"status"];
}
