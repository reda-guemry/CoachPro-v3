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

    public function checkrole()
    {
        $role = Session::getSession('role') ; 

        // var_dump($role) ; 
        // exit ;

        if(empty($role)) {
            header('Location: login');
            exit;
        }

        if ($role == 'coach') {
            header('Location: dhasbordcoach');
            exit;
        }

        header('Location: dhasbord');

    }

}