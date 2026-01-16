<?php

namespace src\app\Controllers\user;


use src\core\Controler;
use src\core\Session;
use src\app\Services\user\CoachService;


class CoachController extends Controler
{


    public function index()
    {

        $data = [
            'coach_id' => Session::getSession('id')
        ];


        $coashServ = new CoachService();
        $reponse = $coashServ->getAllAvaialibities($data);

        $coashBoking = $coashServ->getAllBooking($data);

        // var_dump($coashBoking) ; 
        // exit ; 

        $coashBoking = $coashServ->getAllAccepteboking($data);



        $data = [
            'availabilities' => $reponse,
            'pendingBookings' => $coashBoking,
            'statusColors' => [
                'available' => 'bg-green-100 text-green-800',
                'booked' => 'bg-yellow-100 text-yellow-800',
                'cancelled' => 'bg-red-100 text-red-800'
            ]
        ];
        $this->view('coach/dashbordcoach', $data);

    }

    public function createNewAvail()
    {
        // var_dump($_POST) ; 

        $data = [
            'coach_id' => Session::getSession('id'),
            'availabilities_date' => $_POST['date'],
            'start_time' => $_POST['start'],
            'end_time' => $_POST['end'],
            'status' => 'available'
        ];


        // var_dump(value: $data) ; 
        // exit ;

        $coashServ = new CoachService();
        $reponse = $coashServ->createNewAvaili($data);


        // die ($reponse);

        // var_dump($reponse) ; 
        // exit ;

        if ($reponse['status']) {
            header('Location: ../dhasbordcoach');
        }

        die($reponse);

    }


    public function removeavail()
    {
        $data = [
            'availability_id' => $_POST['availability_id']
        ];

        $coachService = new CoachService();
        $coachService->removeavail($data);

        header('Location: ../dhasbordcoach');

    }

    public function refusebooking()
    {
        $data = [
            'status' => 'rejected'            
        ];
        $condition = [
            'booking_id' => $_POST['booking_id'] 
        ] ;

        $coachService = new CoachService();
        $coachService->gestiondereservation($data , $condition);

        header('Location: ../dhasbordcoach') ; 

    }
     public function acceptebooking()
    {
        $data = [
            'status' => 'accepted'            
        ];
        $condition = [
            'booking_id' => $_POST['booking_id'] 
        ] ;

        $coachService = new CoachService();
        $coachService->gestiondereservation($data , $condition);

        header('Location: ../dhasbordcoach') ; 

    }

    


}