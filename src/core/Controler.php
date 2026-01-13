<?php
namespace core ; 


class Controler {

    public function view($page) {
        require SRC_PATH . 'app/Views/' . $page . '.php';
    }

    
    


}