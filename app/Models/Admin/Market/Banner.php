<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ["url" ,"position" ,"status" ,"image"];

    public static $posision = 
    [
        0 => "بنر اصلی و بزرگ ( بالا سمت راست )",
        1 => "بنر اصلی و کوچک ( بالا سمت چپ اولی )",
        2 => "بنر اصلی و کوچک ( بالا سمت چپ دومی )",
        3 => "بنر وسط ( وسط سمت راست )",
        4 => "بنر وسط ( وسط سمت چپ )",
        5 => "بنر بزرگ پایین ( آخر وب سایت نزدیک فوتر )"
    ];


    public function getPositionBannerAttribute()
    {
        if($this->position == 0){
            return "بنر اصلی و بزرگ ( بالا سمت راست )";
        }elseif($this->position == 1){
            return "بنر اصلی و کوچک ( بالا سمت چپ اولی )";
        }elseif($this->position == 2){
            return  "بنر اصلی و کوچک ( بالا سمت چپ دومی )";
        }elseif($this->position == 3){
            return "بنر وسط ( وسط سمت راست )";
        }elseif($this->position == 4){
            return  "بنر وسط ( وسط سمت چپ )";
        }elseif($this->position == 5){
            return "بنر بزرگ پایین ( آخر وب سایت نزدیک فوتر )";
        }
    }
}
