<?php

namespace src\app\Controllers\auth;


use src\core\Controler;
use src\core\Session ; 
use src\app\Services\auth\AuthentificationService ; 



class AuthentificationController extends Controler {

    public function showRegister ($path) {
        $role = Session::getSession('role') ; 
        if(isset($role)) {
            header('Location: dhasbord') ;
            exit () ;
        }
        $this -> view('auth/register') ;  
        exit () ;
    } 

    public function register(){
        $data = [
            'post' => $_POST , 
            'get' => $_GET
        ];
        $authService = new AuthentificationService ;
        $authService -> register($data) ; 

    }
    
    
}