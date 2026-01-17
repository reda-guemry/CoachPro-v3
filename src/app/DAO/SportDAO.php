<?php 

namespace src\app\DAO;

use src\app\DAO\GenericDAO ;
use src\config\Database; 



class SportDAO extends GenericDAO {

    public function getTablename() {
        return 'sports' ;  

    }





}