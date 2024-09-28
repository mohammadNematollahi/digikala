<?php

namespace App\Http\Services\Message\Email\Traits;

trait EmailService 
{
    public static $details = [];
    public static $subject;
    public static $from = ["address" => null , "name" => null];
    public static $to;

    public function setDetails($details)
    {
        self::$details = $details;
    }

    public function getDetails()
    {
        return self::$details;
    }

    public function setSubject($subject)
    {
        self::$subject = $subject;
    }

    public function getSubject()
    {
        return self::$subject;
    }

    public function setFrom($address , $name)
    {
        self::$from = [
            [
                "address" => $address,
                "name" => $name
            ]
        ];
    }

    public function getFrom()
    {
        return self::$from;
    }

    public function setTo($to)
    {
        self::$to = $to;
    }

    public function getTo()
    {
        return self::$to;
    }
}