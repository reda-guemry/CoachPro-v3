<?php

namespace src\core ;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    private $twig ;

    public function __construct ($twig) {
        $this -> twig = $twig ;
    }

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
            echo $this->twig->render('404.twig');
            exit ; 
        }

        $handler = $this -> routes[$methode][$uri] ; 

        [$controller , $methodeAction] = explode('@' , $handler) ;

        $controller = "src\\app\\Controllers\\$controller" ;
        $object = new $controller($this -> twig) ; 
        
        call_user_func([$object , $methodeAction] , $request ) ;
        
    }

}