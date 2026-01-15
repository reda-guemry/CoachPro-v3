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

        $authService = new AuthentificationService;
        $reponse = $authService->register($data);

        var_dump($reponse) ;

        echo 'slm ';
        exit ;

        if($reponse) {
            header('Location: login') ; 
        }else  {
            die ('hmaaaaar hadche ghalat') ; 
        }

    }


}