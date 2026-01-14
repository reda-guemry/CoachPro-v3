<?php

namespace src\app\Services\auth;

class AuthentificationService
{



    public function register(array $data)
    {
        extract($data['post']);

    }


    public function ceckMailExist($email)
    {
        
    }

}