<?php
namespace App;

class Autoloader
{
    public static function register(){

        spl_autoload_register(function ($class){

            $class = str_replace("\\", "/", $class);
            $class = str_ireplace(__NAMESPACE__, "", $class);
            $class .= ".php";
            $class = ltrim($class, "/");

            if(file($class)){
                include $class;
            }
        });
    }
}