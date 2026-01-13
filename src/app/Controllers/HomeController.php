<?php 
namespace App\Controllers;
use core\Controler;

class HomeController extends Controler{
    public function index() {
        $this -> view('home') ; 
    }
}