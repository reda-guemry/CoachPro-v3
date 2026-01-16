<?php

namespace src\app\Models;;

use src\app\DAO\BookingDAO;

class User
{
    private int $user_id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private string $role;

    private $bookings ; 

    public function __construct() {
        $bokingDAO = new BookingDAO() ; 
        $id = ['user_id' => $this -> getUserId()] ; 
        $this -> bookings = $bokingDAO -> getall($id) ; 

    }

    /* ========= GETTERS ========= */

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    /* ========= SETTERS ========= */

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    
}
