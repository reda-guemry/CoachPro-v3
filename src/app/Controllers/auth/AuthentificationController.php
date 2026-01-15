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
        $this->view('auth/register');
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
            $bio = trim($_POST['bio'] ?? '');
            $experienceYears = $_POST['experienceYears'] ?? 0;
            $certifications = trim($_POST['certifications'] ?? '');
            $profilephoto = $_FILES['photo'];
        }

        if ($data['role'] === 'coach') {
            $coachProfileData = [
                'bio' => trim($_POST['bio'] ?? ''),
                'experience_year' => (int) ($_POST['experienceYears'] ?? 0),
                'certification' => trim($_POST['certifications'] ?? ''),
                'photo' => $_FILES['photo']
            ];
        }

        $authService = new AuthentificationService;
        $reponse = $authService->register($data, $coachProfileData);

        // var_dump($reponse);

        // echo 'slm ';
        // exit;

        if ($reponse) {
            header('Location: login');
        } else {
            die('hmaaaaar hadche ghalat');
        }

    }

    public function showLogin()
    {
        $role = Session::getSession('role');
        if (isset($role)) {
            // header('Location: dhasbord');
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

        if (!$result['status']) {
            return $result;
        }

        $user = $result['user'];

        // session_regenerate_id(true);

        Session::setSession('role', $user->getRole());
        Session::setSession('user_id', $user->getEmail());
        Session::setSession('id', $user->getUserId());

        // die ($user -> getRole() ) ;

        $this -> checkrole() ; 
    }

}