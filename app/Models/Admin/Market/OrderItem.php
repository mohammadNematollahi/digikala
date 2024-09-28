<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin\Market\Product;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = ["amazing_sale_object" => "array" , "product" => "array"];
    protected $fillable = [ "order_id" , "product_id", "product" , "amazing_sale_id" , "amazing_sale_object", "amazing_sale_discount_amount", "number", "final_product_price", "final_total_price", "color_id", "warranty_id"];

    public function getPaymentStatusValueAttribute()
    {
        $value = "";
        if ($this->payment_status == 0) {
            $value = "پرداخت نشده";
        } elseif ($this->payment_status == 1) {
            $value = "پرداخت شده";
        } elseif ($this->payment_status == 2) {
            $value = "باطل شده";
        } else {
            $value = "بازگشت داده شده";
        }
        return $value;
    }

    public function itemProduct()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }

    public function amazingSale()
    {
        return $this->belongsTo(AmazingSale::class, "amazing_sale_id", "id");
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, "color_id");
    }

    public function warranty()
    {
        return $this->belongsTo(Warranty::class, "warranty_id");
    }

    public function orderItemAttributes()
    {
        return $this->hasMany(OrderItemSelectedAttribute::class, "order_item_id");
    }
}
