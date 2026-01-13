<?php

namespace core ;

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


    public function execute(Request $request)
    {
        $uri = $request -> uri() ; 
        $methode = $request -> method() ; 


        if (!isset($this->routes[$methode][$uri])) {
            die('404 Not Found');
        }

        $handler = $this -> routes[$methode][$uri] ; 

        [$controller , $methodeAction] = explode('@' , $handler) ;

        $controller = "src\\app\\Controllers\\$controller" ;
        $object = new $controller ; 
        
        call_user_func([$object , $methodeAction] , $request ) ;
        
    }

}