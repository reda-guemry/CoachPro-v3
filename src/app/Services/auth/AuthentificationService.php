<?php

namespace src\app\Services\auth;

use src\app\DAO\auth\AuthentificationDAO;
use src\app\DAO\CoachsportDAO;
use src\app\DAO\SportDAO;
use src\app\DAO\user\UserdetailDAO;

class AuthentificationService
{

    public function register(array $data, ?array $coachProfileData = null, ?array $coachSport = null)
    {

        $authDAO = new AuthentificationDAO();

        // var_dump($coachProfileData) ; 
        // exit ; 


        $reponse = $this->checkMailExist($data['email'], $authDAO);

        if (!$reponse['status']) {
            return $reponse;
        }

        if (empty($data['email']) || empty($data['password'])) {
            return [
                'status' => false,
                'message' => 'Tous les champs sont obligatoires.'
            ];
        }

        if (strlen($data['password']) < 8) {
            return [
                'status' => false,
                'message' => 'Le mot de passe doit contenir au moins 8 caractères.'
            ];
        }

        if (isset($data['confirmPassword']) && $data['password'] !== $data['confirmPassword']) {
            return [
                'status' => false,
                'message' => 'Les mots de passe ne correspondent pas.'
            ];
        }

        unset($data['confirmPassword']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $userId = $authDAO->create($data);

        if ($data['role'] == 'coach') {
            $coachProfileData['coach_id'] = $userId;


            // $coachProfileData['coach_id'] = 1 ;


            $reponse = $this->moveprofilephoto($coachProfileData['photo']);
            // die ($reponse . 'swoksow') ;

            if ($reponse) {
                $coachProfileData['photo'] = $reponse;
            } else {
                return $reponse;
            }

            $uDetailDAO = new UserdetailDAO();
            $uDetailDAO->create($coachProfileData);

            // $coachSport['coach_id'] = $userId ;

            $sports = new CoachsportDAO();

            foreach ($coachSport['sports'] as $sport) {
                $csport = [
                    'sport_id' => $sport,
                    'coach_id' => $userId
                ];
                $sports->create($csport);
            }

            // exit;

        }

        return $userId;
    }

    private function moveprofilephoto($file)
    {
        // var_dump($file)  ;
        // exit ;
        if ($file['error'] === 0) {
            $filename = uniqid() . '_' . $file['name'];
            $pathfile = SRC_PATH . '/public/assets/image/' . $filename;
            if (move_uploaded_file($file['tmp_name'], $pathfile)) {
                return $filename;
            }
        }
        return false;
    }


    private function checkMailExist($email, $authDAO)
    {
        if ($authDAO->findByEmail($email)) {
            return [
                'status' => false,
                'message' => 'email deja exist'
            ];
        }

        return [
            'status' => true
        ];

    }

    private function getUser($email, AuthentificationDAO $authDAO)
    {
        return $authDAO->findByEmail($email);
    }

    public function login($email, $password)
    {
        $uDetailDAO = new AuthentificationDAO();

        $user = $this->getUser($email, $uDetailDAO);

        if (!$user) {
            return [
                'status' => false,
                'message' => 'email note exist'
            ];
        }

        // var_dump($user) ; 
        // exit ; 

        if (password_verify($password, $user->getPassword())) {
            return [
                'status' => true,
                'user' => $user
            ];
        }

        return [
            'status' => false,
            'message' => 'password uncorect'
        ];
    }

    public function getsports()
    {
        $sportDAO = new SportDAO();
        return $sportDAO->getall();


    }

}