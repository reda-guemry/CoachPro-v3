<?php 
namespace src\App\Controllers;
use src\core\Controler;

class HomeController extends Controler{
    public function index() {
        $this -> view('home') ; 
    }
}