<?php

namespace App\Http\Services\Message\Email\Traits;

trait CallMethod
{
    private $instance = null;
    public static function __callStatic($method, $args)
    {
        $class = get_called_class();
        if(self::$instance == null){
            self::$instance = new $class();
        }
        return call_user_func_array(array(self::$instance, $method), $args);
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array($this, $method), $args);
    }
}