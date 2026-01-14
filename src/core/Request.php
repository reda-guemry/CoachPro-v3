<?php

namespace src\core;

class Request
{

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $base = '/CoachPro-v3/';
        if (strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }
        // die ($uri) ; 
        return $uri ?: '/';
    }

}