<?php
namespace src\core ; 


class Controler {

    public function view($page) {

        require SRC_PATH . '/app/Views/Partials/nav.twig'; // add nav in evry page 

        require SRC_PATH . '/app/Views/' . $page . '.twig'; //add the page need

        require SRC_PATH . '/app/Views/Partials/fotter.twig'; // add foter in evry page

    }



}