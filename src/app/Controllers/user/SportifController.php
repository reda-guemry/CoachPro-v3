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
        $this -> checksportif() ; 

        // $data = ['role' => 'coach'];
        $sportifID = ['sportif_id' => Session::getSession('id')];
        $newCoachDAO = new SportifService();

        $coach = $newCoachDAO->getAllCoach();

        $sportifbooking = new SportifService();
        $bookings = $sportifbooking->getallbooking($sportifID);



        // foreach ($coacheDetails as $coach) {
        //     echo $coach -> getPhoto() ;
        // }

        // var_dump( $bookings  ) ; 
        // exit ; 

        $data = [
            'coachs' => $coach,
            'sportifbooking' => $bookings,
            'userRole' => Session::getSession('role') , 
            'statusColors' => [
                "pending" => 'bg-yellow-100 text-yellow-800',
                "accepted" => 'bg-green-100 text-green-800',
                "rejected" => 'bg-red-100 text-red-800',
                "cancelled" => 'bg-gray-100 text-gray-800'

            ]
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
            'status' => 'pending',
            'availability_id' => $_POST['seanseSelect']

        ];

        $sportifService = new SportifService();
        $sportifService->createreservation($data);


        header('Location: ../dhasbord');

    }


    public function annulerreservation() {
        $data = ['booking_id' => $_POST['bookingId']]; 
        $update = ['availability_id' => $_POST['availibiliterID']]; 


        $sportifService = new SportifService() ; 
        $sportifService -> annulerreservation($data , $update);

        header('Location: ../dhasbord') ; 
        exit ; 

    }

    public function createcommentaire() {
        $data = [
            'booking_id' => $_POST['reviewBookingId'] , 
            'commentaire' => $_POST['reviewComment'] , 
            'ratting' => $_POST['ratingValue']
        ] ; 


        $sportifServ = new SportifService() ; 

        $sportifServ -> createcommentaire($data) ; 

        header('Location: ../dhasbord') ; 
        exit ; 



    }


}