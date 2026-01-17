<?php 

namespace src\app\DAO;

use src\app\DAO\GenericDAO ;
use src\config\Database; 



class CoachsportDAO extends GenericDAO {

    public function getTablename() {
        return 'coach_sport' ;  

    }





}