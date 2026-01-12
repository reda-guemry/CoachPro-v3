<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define('SRC_PATH' , dirname(__DIR__)) ;

require_once __DIR__ . '/../core/Router.php' ; 
require_once __DIR__ . '/../core/Request.php' ;


$router = new Router ; 
$request = new Request ; 

$router -> get ('/user' , 'usercontroler@index')  ;
$router -> get ('' , 'usercontroler@index')  ;
$router -> get ('/' , 'slm')  ;




echo $router -> execute($request) ; 
