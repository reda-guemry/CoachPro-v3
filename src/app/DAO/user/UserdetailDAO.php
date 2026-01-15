<?php 

namespace src\app\DAO\user;

use src\app\DAO\GenericDAO ;
use src\config\Database; 



class UserdetailDAO extends GenericDAO {

    public function getTablename() {
        return 'user_details' ;
    }
    
    
}