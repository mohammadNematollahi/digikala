<?php

namespace App\Models\Admin\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $casts = ["address_object" => "array" , "delivery_object" => "array", "common_discount_object" => "array" , "copan_object" => "array" ];
    protected $fillable = ["user_id" , "address_object" , "delivery_object" ,"address_id" ,"delivery_id" , "order_total_products_discount_amount" , "order_common_discount_amount" , "common_discount_id" , "order_discount_amount" , "order_final_amount" , "common_discount_object" , "copan_id" , "copan_object" , "order_copan_discount_amount"];

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

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function address()
    {
        return $this->belongsTo(Address::class, "address_id", "id");
    }

    public function copan()
    {
        return $this->belongsTo(Copan::class, "copan_id", "id");
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, "payment_id", "id");
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class, "common_discount_id", "id");
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, "order_id", "id");
    }
}
