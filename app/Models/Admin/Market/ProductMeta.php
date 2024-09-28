<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMeta extends Model
{
    use HasFactory , SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class , "product_id" ,"id");
    }

    protected $table = "product_meta";
    protected $fillable = ["product_key" , "product_value" , "product_id"];
}
