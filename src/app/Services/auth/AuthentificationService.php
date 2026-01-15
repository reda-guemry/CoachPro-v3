<?php

namespace src\app\Services\auth;

use src\app\DAO\auth\AuthentificationDAO;

class AuthentificationService
{

    private AuthentificationDAO $authDAO ; 


    public function __construct() {
        $this -> authDAO = new AuthentificationDAO() ;
    }


    public function register(array $data)
    {
            


        $reponse = $this->checkMailExist($data['email']) ;   

        if(!$reponse['status']) {
            return $reponse ; 
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
        $data['password'] = password_hash($data['password'] , PASSWORD_DEFAULT) ;

        $reponse = $this -> authDAO ->  create($data) ;
        
        
        return $reponse ; 

    }


    public function checkMailExist($email)
    {
        if ($this -> authDAO ->findByEmail($email)) {
            return [
                'status' => false,
                'message' => 'email deja exist'
            ];
        }

        return [
            'status' => true 
        ];

    }

}