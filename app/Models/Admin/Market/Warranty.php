<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["name" , "product_id" , "price_increase"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
