<?php

namespace App\Models\Admin\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["amount" , "paymentable_type" , "paymentable_id" , "user_id" , "type"];
    protected $guarded = ["id" , "user_id"];

    public function paymentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }
}
