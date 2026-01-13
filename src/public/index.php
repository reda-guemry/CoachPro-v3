<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define('SRC_PATH' , dirname(__DIR__)) ;

require_once __DIR__ . '/../core/autoload.php' ;

use core\Router ;
use core\Request ;

$router = new Router ; 
$request = new Request ; 

$router -> get ('/user' , 'usercontroler@index')  ;
$router -> get ('/' , 'usercontroler@index')  ;

echo $router -> execute($request) ; 
