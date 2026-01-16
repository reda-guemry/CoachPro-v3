<?php

namespace src\app\Controllers\user;

use src\core\Controler;
use src\core\Session;
use src\app\Services\user\SportifService;
use src\app\Services\user\UserdeatilService;



class SportifController extends Controler
{


    public function index()
    {
        $data = ['role' => 'coach'];
        $newCoachDAO = new SportifService();
        $coach = $newCoachDAO->getAllCoach($data);


        $newCoachDeatailsSERV = new UserdeatilService();
        $coacheDetails = $newCoachDeatailsSERV->getalldetailscoaches();

        // foreach ($coacheDetails as $coach) {
        //     echo $coach -> getPhoto() ;
        // }

        // var_dump(value: $coach  ) ; 
        // exit ; 

        $data = [
            'coachs' => $coach,
            'coachsDeatail' => $coacheDetails
        ];

        $this->view('sportif/dashbordsportif', $data);


    }

    public function getAvailabilityByDate()
    {
        header("Content-Type: application/json");

        $getcontent = json_decode(file_get_contents("php://input"), true);

        $data = [
            'availabilities_date' => $getcontent["dateselect"],
            'coach_id' => $getcontent['coach_id'],
            'status' => 'available'
        ];

        $sportifService = new SportifService();
        $reponse = $sportifService->getavailibiliterbydate($data);


        if (!$reponse) {
            echo json_encode([
                "status" => "empty",
                "message" => "Aucune disponibilité pour ce jour"
            ]);
            exit;
        }
        $data = [];
        foreach ($reponse as $repo) {
            $data[] = [
                'availability_id' => $repo->getAvailabilityId(),
                'start_time' => $repo->getStartTime(),
                'end_time' => $repo->getEndTime()
            ];
        }

        echo json_encode([
            "status" => "success",
            "data" => $data
        ]);
    }


    public function createreservation()
    {

        $data = [
            'coach_id' => $_POST['coach_id'],
            'sportif_id' => Session::getSession('id'),
            'status' => 'pending' , 
            'availability_id' => $_POST['seanseSelect']

        ];

        $sportifService = new SportifService();
        $sportifService-> createreservation ($data);


        header('Location: ../dhasbord') ; 

    }

}