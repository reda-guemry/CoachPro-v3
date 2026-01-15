<?php

namespace src\app\Services\user;

use src\app\DAO\AvailabilitesDAO;


class CoachService
{


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

        if($reponse) {
            return [
                'status' => true 
            ];
        }

        die ($reponse) ; 

    }


}