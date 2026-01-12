<?php

use core\Request;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $actiom)
    {
        $this->routes['GET'][$uri] = $actiom;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }


    public function execute( $request)
    {
        $uri = $request -> uri() ; 
        $methode = $request -> method() ; 
        $handler = $this -> routes[$methode][$uri] ; 

        return $handler ?: '/' ; 
        
    }

}