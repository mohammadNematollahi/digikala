<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use HasFactory , SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class , "product_id" , "id");
    }

    protected $fillable = ["color_name" , "product_id" ,"price_increase" ,"status", "sold_number" ,"sold_number" ,"marketable_number" , "color"];
}
