<?php

namespace src\app\Controllers\user;

use src\core\Controler;
use src\core\Session;


class SportifController extends Controler
{


    public function index()
    {
        $this->view('sportif/dashbordsportif');
    }

}