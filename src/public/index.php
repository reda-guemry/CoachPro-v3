<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


define('SRC_PATH' , dirname(__DIR__)) ;

require_once __DIR__ . '/../core/autoload.php' ;
require_once __DIR__ . '/../../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(SRC_PATH . '/app/Views/');
$twig = new Environment($loader);

use core\Router ;
use core\Request ;

$router = new Router ; 
$request = new Request ; 

require_once SRC_PATH . '/routes/web.php' ;

$router -> execute($request) ; 
