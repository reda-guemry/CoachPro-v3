<?php 

namespace src\app\Services\user ;

use src\app\DAO\user\UserDAO;


class SportifService {

    public function getAllCoach ($data) {

    //   var_dump($data) ; 
    //     exit ; 

        $coachdAO = new UserDAO() ; 
        return $coachdAO -> getall($data) ; 
        
    }

}