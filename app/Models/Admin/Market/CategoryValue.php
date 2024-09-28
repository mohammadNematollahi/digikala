<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryValue extends Model
{
    use HasFactory , SoftDeletes;

    protected $casts  = ["value" => "array"];


    public function product()
    {
        return $this->belongsTo(Product::class , "product_id" , "id");
    }

    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class , "category_attribute_id" , "id");
    }

    protected $fillable = ['product_id' , "category_attribute_id" , "value"];
}
