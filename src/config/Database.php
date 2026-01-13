<?php

namespace Config; ; 
use PDO;
use PDOException;

class Database
{

    private PDO $db;
    private static ?Database $instance = null;


    public function __construct()
    {

        try {
            $this->db = new PDO('pgsql:host=localhost;port=5432;dbname=coachprov3;', 'root', 'root', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);


        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database() ; 
        }

        return self::$instance ; 

    }

    public function getConnect() {
        return $this -> db ; 
    }
    
}