<?php

namespace App\Models;

use App\Models\Admin\Market\Product;
use App\Models\Admin\Market\ProductColor;
use App\Models\Admin\Market\Warranty;
use App\Traits\HasSaleProcess;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory , SoftDeletes , HasSaleProcess;

    protected $fillable = ["user_id" , "product_id" ,"color_id" , "number" , "warranty_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }

}
