<?php

namespace src\app\DAO\user;

use src\app\DAO\GenericDAO;
use src\config\Database;



class UserDAO extends GenericDAO
{


    public function getTablename()
    {
        return 'users';
    }

}