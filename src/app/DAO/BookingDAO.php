<?php 

namespace src\app\DAO;

use src\app\DAO\GenericDAO ;
use src\config\Database; 



class BookingDAO extends GenericDAO {

    public function getTablename() {
        return 'bookings' ;  
    }

    




}