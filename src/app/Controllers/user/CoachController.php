<?php

namespace src\app\Controllers\user;


use src\core\Controler;
use src\core\Session;
use src\app\Services\user\CoachService ; 


class CoachController extends Controler
{


    public function index()
    {
        $this->view('coach/dashbordcoach');

    }

    public function createNewAvail() {
        var_dump($_POST) ; 

        $data = [ 
            'coach_id' => Session::getSession('role') , 
            'availabilites_date' => $_POST['date'] , 
            'start_time' => $_POST['start'] , 
            'end_time' => $_POST['end'] , 
            'status' => 'available'
        ] ;

        $coashServ = new CoachService() ; 
        $reponse = $coashServ -> createNewAvaili($data) ;



    }




}