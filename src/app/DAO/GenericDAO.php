<?php 

namespace src\app\DAO;
use PDOException;
use src\app\DAO\user\UserdetailsDAO;
use src\config\Database ; 
use PDO ; 


abstract class GenericDAO {

    private $classes = [
        'users' => User::class ,
        'user_details' => Userdetail::class , 
        'availabilites' => Availabilite::class , 
        'bookings' => Booking::class , 
        'reviews' => Review::class 
    ] ;
    

    abstract public function getTablename() ; 

    public function getTargetClass() {
        $table = $this -> getTablename() ;
        
        if (isset($this -> classes[$table])){
            return $this -> classes[$table] ; 
        }
        
    }

    public function getall() {
        $table = $this -> getTablename() ; 

        $sql = "SELECT * FROM $table " ; 

        try {
            $stmt = Database::getInstance() -> getConnect() -> prepare($sql) ; 
            $result = $stmt -> fetchALl(PDO::FETCH_CLASS , $this -> getTargetClass()) ;
            
            return $result ;

        }catch(PDOException $e) {
            return false ;
        }

    }


    public function create($data) {
        $table = $this -> getTablename() ; 

        $columns = implode(', ' , array_keys($data))  ;
        $placeholder =  implode(', ' , array_fill(0 , count($data) , '?' )) ;

        // var_dump($columns , $placeholder) ; 
        // exit ; 
        

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholder)" ; 

        try {
            
            $pdo = Database::getInstance() -> getConnect() ;
            $stmt = $pdo -> prepare($sql) ;
            $stmt -> execute (array_values($data)) ; 
            
            $id = $pdo -> lastInsertId() ;

            // die ($id) ; 
            
            return $id ; 

        }catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

    }

    public function findbyid($id) {
        $table = $this -> getTablename() ; 
        
        $sql = "SELECT * FROM $table WHERE id = ?" ;
        
        try {
            $pdo = Database::getInstance() -> getConnect() ;
            $stmt = $pdo -> prepare($sql) ;
            $stmt -> execute (array_values($id)) ; 
            
            $result = $stmt -> fetch(PDO::FETCH_CLASS , $this -> getTargetClass()) ; 

            return $result ;

        }catch (PDOException $e) {
            return false ; 
        }

    }


}