<?php
namespace src\core;


class Controler
{

    protected $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function view($page, $data = [])
    {
        $fileName = $page . '.twig' ; 
        echo $this->twig->render($fileName, $data);

    }

}