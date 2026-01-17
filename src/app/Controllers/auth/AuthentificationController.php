<?php

namespace src\app\Controllers\auth;


use src\core\Controler;
use src\core\Session;
use src\app\Services\auth\AuthentificationService;



class AuthentificationController extends Controler
{

    public function showRegister($path)
    {
        $role = Session::getSession('role');
        if (isset($role)) {
            header('Location: dhasbord');
            exit();
        }

        $authService = new AuthentificationService;
        $sports = $authService-> getsports();

        // var_dump($sports) ;
        // exit ; 

        $data = [
            'sports' => $sports
        ];

        $this->view('auth/register', $data);
        exit();
    }

    public function register()
    {
        $data = [
            'role' => $_POST['role'] ?? 'sportif',
            'first_name' => trim($_POST['prenom'] ?? ''),
            'last_name' => trim($_POST['nom'] ?? ''),
            'email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
            'password' => $_POST['password'] ?? '',
            'confirmPassword' => $_POST['confirmPassword'] ?? ''
        ];

        if ($data['role'] === 'coach') {
            $coachProfileData = [
                'bio' => trim($_POST['bio'] ?? ''),
                'experience_year' => (int) ($_POST['experienceYears'] ?? 0),
                'certification' => trim($_POST['certifications'] ?? ''),
                'photo' => $_FILES['photo']
            ];

            $coachSport = [
                'sports' => $_POST['sports'] 
            ];

            // var_dump($coachSport);

            // echo 'slm ';
            // exit;

        }

        $authService = new AuthentificationService;
        $reponse = $authService->register($data, $coachProfileData , $coachSport );

        if ($reponse) {
            header('Location: login');
            exit ; 
        } else {
            die('error hna');
        }

    }

    public function showLogin()
    {
        $role = Session::getSession('role');
        if (isset($role)) {
            header('Location: dhasbord');
            exit();
        }
        $this->view('auth/login');
        exit();

    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $authService = new AuthentificationService();
        $result = $authService->login($email, $password);

        // var_dump($result) ; 
        // exit ; 

        if (!$result['status']) {
            $this->checkrole();

            return $result;
        }

        $user = $result['user'];

        // session_regenerate_id(true);


        Session::setSession('role', $user->getRole());
        Session::setSession('email', $user->getEmail());
        Session::setSession('id', $user->getUserId());

        // echo  Session::getSession('id');     
        // echo $user->getUserId() ; 

        // exit ; 


        // die ($user -> getRole() ) ;

        $this->checkrole();
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: /CoachPro-v3') ; 
    }

}