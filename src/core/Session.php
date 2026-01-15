<?php

namespace src\core;

class Session {

    public static function getSession($key) {
        return $_SESSION[$key] ?? null ; 
    }

    public static function setSession($key , $value) {
        $_SESSION[$key] = $value ; 
    } 
    

}