<?php

namespace src\app\Services\user;

use src\app\DAO\AvailabilitesDAO;
use src\app\DAO\BookingDAO;


class CoachService
{


    public function getAllAvaialibities($coashId)
    {
        $coachDAO = new AvailabilitesDAO;
        $reponse = $coachDAO->getall($coashId);

        // var_dump($reponse) ; 
        // exit ;

        return $reponse;

    }


    public function createNewAvaili($data)
    {

        if ($data['start_time'] > $data['end_time']) {
            return [
                'status' => false,
                'message' => 'date start should be superieur then end time'
            ];
        }

        $coachDAO = new AvailabilitesDAO;
        $reponse = $coachDAO->create($data);

        // die ($reponse) ;

        if ($reponse) {
            return [
                'status' => true
            ];
        }

        die($reponse);

    }

    public function removeavail($data)
    {
        $coachDAO = new AvailabilitesDAO;
        $coachDAO->delete($data);


    }

    public function getAllBooking($data)
    {

        // var_dump($data) ; 
        // exit ;

        $bookingDAO = new BookingDao;
        // return $bookingDAO->getall($data[]);

        return $bookingDAO->getbookings($data['coach_id']);

    }

    public function gestiondereservation($data , $condition)
    {

        $bookingDAO = new BookingDao;

        return $bookingDAO->update($data , $condition);

    }

}