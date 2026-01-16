<?php 

namespace src\app\Services\user ;

use src\app\DAO\user\UserDAO;
use src\app\DAO\AvailabilitesDAO ;
use src\config\Database; 


class SportifService {

    public function getAllCoach ($data) {

    //   var_dump($data) ; 
    //     exit ; 

        $coachdAO = new UserDAO() ; 
        return $coachdAO -> getall($data) ; 
        
    }

    public function getavailibiliterbydate($data) {
        $availabilitesDAO = new AvailabilitesDAO ; 
        return $availabilitesDAO -> getall($data) ; 
    }

    public function createreservation($data) {
        $db = Database::getInstance() -> getConnect() ;
        
        $

    }


}