<?php

namespace src\app\Services\user;

use src\app\DAO\user\UserDAO;
use src\app\DAO\AvailabilitesDAO;
use src\config\Database;
use src\app\DAO\BookingDAO;


class SportifService
{

    public function getAllCoach($data)
    {

        //   var_dump($data) ; 
        //     exit ; 

        $coachdAO = new UserDAO();
        return $coachdAO->getall($data);

    }

    public function getavailibiliterbydate($data)
    {
        $availabilitesDAO = new AvailabilitesDAO;
        return $availabilitesDAO->getall($data);
    }

    public function createreservation($data)
    {
        $db = Database::getInstance()->getConnect();
        
        $bookingDAO = new BookingDAO;




        $atttibute = array_key_last($data);
        $conditionmodification = [$atttibute => $data[$atttibute]]; 

        $dataupdate = ['status' => 'booked'] ;
        

        $availabilitesDAO = new AvailabilitesDAO;
        
        
        
        $db->beginTransaction();
        
        $bookingDAO->create($data);
        
        $availabilitesDAO->update($dataupdate , $conditionmodification);


        $db->commit();


    }


}