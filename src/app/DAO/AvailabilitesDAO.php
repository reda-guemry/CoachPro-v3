<?php 

namespace src\app\DAO;

use src\app\DAO\GenericDAO ;
use src\config\Database; 



class AvailabilitesDAO extends GenericDAO {

    public function getTablename() {
        return 'availabilities' ;  

    }


}