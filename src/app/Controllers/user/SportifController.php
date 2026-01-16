<?php

namespace src\app\Controllers\user;

use src\core\Controler;
use src\core\Session;
use src\app\Services\user\SportifService ;
use src\app\Services\user\UserdeatilService;



class SportifController extends Controler
{


    public function index()
    {
        $data = ['role' => 'coach'] ; 
        $newCoachDAO = new SportifService () ; 
        $coach = $newCoachDAO -> getAllCoach($data) ;


        $newCoachDeatailsSERV = new UserdeatilService() ;
        $coacheDetails = $newCoachDeatailsSERV -> getalldetailscoaches() ; 


        // var_dump(value: $coacheDetails  ) ; 
        // exit ; 

        $data = [ 
            'coachs' => $coach , 
            'coachsDeatail' => $coacheDetails 
        ] ;

        $this->view('sportif/dashbordsportif' , $data);


    }


}