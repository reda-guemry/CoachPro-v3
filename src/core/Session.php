<?php

namespace src\core;

class Session {

    public static function getSession($key) {
        return $_SESSION[$key] ?? null ; 
    }

}