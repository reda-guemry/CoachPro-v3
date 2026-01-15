<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('SRC_PATH' , dirname(__DIR__)) ;

require_once __DIR__ . '/../../vendor/autoload.php';

session_start() ;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use src\core\Router;  
use src\core\Request;  
use src\config\Database ; 


$loader = new FilesystemLoader(SRC_PATH . '/app/Views/');
$twig = new Environment($loader);

$router = new Router($twig); 
$request = new Request; 

require_once SRC_PATH . '/routes/web.php';

// $pdo = Database::getInstance() -> getCOnnect() ; 
// $stmt = $pdo -> query('SELECT * FROM users') ; 
// $stmt -> fetchAll();


$router->execute($request);