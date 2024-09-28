<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ["user_id" , "city_id" ,"address" , "no" ,"unit" , "recipient_first_name" , "recipient_last_name" , "mobile" , "postal_code"];

    public function city()
    {
        return $this->belongsTo(City::class , "city_id" , "id");
    }

    public function recipientFullName()
    {
        if($this->recipient_first_name != null && $this->recipient_last_name != null){

            return $this->recipient_first_name . " " . $this->recipient_last_name;

        }

        return auth()->user()->fullName;
    }
}
