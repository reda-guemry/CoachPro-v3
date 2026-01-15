<?php

namespace src\app\DAO;
use PDOException;
use src\app\DAO\user\UserdetailsDAO;
use src\config\Database;
use PDO;
use src\app\Models\User;
use src\app\Models\Availabilite ; 

abstract class GenericDAO
{

    private $classes = [
        'users' => User::class,
        'user_details' => Userdetail::class,
        'availabilities' => Availabilite::class,
        'bookings' => Booking::class,
        'reviews' => Review::class
    ];


    abstract public function getTablename();

    public function getTargetClass()
    {
        $table = $this->getTablename();

        if (isset($this->classes[$table])) {
            return $this->classes[$table];
        }

    }

    public function getall(?array $id = null)
    {
        $table = $this->getTablename();
        $params = [];

        if ($id) {
            $column = array_key_first($id);
            
            $value = $id[$column];
            $sql = "SELECT * FROM $table WHERE $column = ? ";

            $params = [$value];
            
        } else {
            $sql = "SELECT * FROM $table ";
        }

        try {
            $pdo = Database::getInstance()->getConnect();
            $stmt = $pdo->prepare($sql);
            $stmt -> execute($params) ; 

            $result = $stmt->fetchALl(PDO::FETCH_CLASS, $this->getTargetClass());

            // var_dump ($result) ; 
            // exit;

            return $result;

        } catch (PDOException $e) {
            return false;
        }

    }

    // authService
    public function create($data)
    {
        $table = $this->getTablename();

        $columns = implode(', ', array_keys($data));
        $placeholder = implode(', ', array_fill(0, count($data), '?'));

        // var_dump($columns , $placeholder) ; 
        // exit ; 


        $sql = "INSERT INTO $table ($columns) VALUES ($placeholder)";

        try {

            $pdo = Database::getInstance()->getConnect();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($data));

            $id = $pdo->lastInsertId();

            // die ($id) ; 

            return $id;

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

    }

    public function findbyid($id)
    {
        $table = $this->getTablename();

        $sql = "SELECT * FROM $table WHERE id = ?";

        try {
            $pdo = Database::getInstance()->getConnect();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($id));

            $result = $stmt->fetch(PDO::FETCH_CLASS, $this->getTargetClass());

            return $result;

        } catch (PDOException $e) {
            return false;
        }

    }


}