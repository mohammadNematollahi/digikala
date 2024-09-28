<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class , "product_id" ,"id");
    }
    protected $fillable = ["image" , "product_id"];
}
