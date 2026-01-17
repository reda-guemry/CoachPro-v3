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

    public function  getallbooking($id) {

        $bookingDAO = new BookingDAO() ; 
        return $bookingDAO -> getsportifbooking($id) ;
        
    }

    public function annulerreservation($data , $update) {

        $db = Database::getInstance()->getConnect();

        $dataupdate = ['status' => 'available'] ;


        $bookingDAO = new BookingDAO() ; 

        $availabilitesDAO = new AvailabilitesDAO;

        
        $bookingDAO -> delete($data) ; 

        $db->beginTransaction();

        $availabilitesDAO -> update($dataupdate, $update) ; 
        
        $bookingDAO -> delete($data) ; 



        $db->commit();

        

    }

}