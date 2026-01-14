<?php

namespace src\app\Controllers\auth;


use src\core\Controler;
use src\core\Session ; 


class AutentificationControllers extends Controler {

    public function register ($path) {
        $role = Session::getSession('role') ; 
        if(isset($role)) {
            header('Location: dhasbord') ;
            exit () ;
        }
        $this -> view('auth/register') ;  
        exit () ;
    } 

}