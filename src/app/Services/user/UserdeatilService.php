<?php

namespace src\app\Services\user;

use src\app\DAO\user\UserdetailDAO;


class UserdeatilService
{
    public function getalldetailscoaches() {
        
        $userdetailsdao = new UserdetailDAO() ; 
        return $userdetailsdao -> getall() ; 



    }

}