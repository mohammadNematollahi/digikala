<?php
use Morilog\Jalali\Jalalian;

function convertToShamsi($date , $format = "%B %d، %Y")
{
    return Jalalian::forge($date)->format($format);
}

function convertToMB($bytes)
{
    if($bytes >= 1048576){
       return $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    return $bytes = number_format($bytes / 1024, 2) . ' KB';
}

function priceFormat($price)
{
    return persianNumber(number_format($price));
}

function persianNumber($number)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    $num = range(0, 9);
    $convertedPersianNums = str_replace($num, $persian, $number);
    
    return $convertedPersianNums;
}

function final_price_discount($price , $discount)
{
    return $price - ($price * ($discount / 100));
}

function discount($price , $discount)
{
    return ($price * $discount) / 100;
}