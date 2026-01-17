<?php 
namespace src\App\Controllers;

use src\core\Controler;
use src\core\Session;

class HomeController extends Controler{
    public function index() {

        $data = [
            'userRole' => Session::getSession('role')
        ] ;
        
        $this -> view('home' , $data) ;
    }


}