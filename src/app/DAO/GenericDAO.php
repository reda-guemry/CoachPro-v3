<?php 

namespace src\app\DAO;
use PDOException;
use src\config\Database ; 
use PDO ; 


abstract class GenericDAO {

    private $classes = [
        'users' => User::class ,
        'coach_profile' => DetailsUser::class , 
        'coach_sport' => '',
        'availabilites' => Availabilite::class , 
        'bookings' => Booking::class , 
        'reviews' => Review::class 
    ] ;
    

    abstract public function getTablename() ; 
    abstract public function getcolumns() ; 

    public function getTargetClass() {
        $table = $this -> getTablename() ;
        
        if (isset($this -> classes[$table])){
            return $this -> classes[$table] ; 
        }
        
    }

    public function getall() {
        $table = $this -> getTablename() ; 

        $sql = 'SELECT * FROM $table ' ; 

        try {
            $stmt = Database::getInstance() -> getConnect() -> prepare($sql) ; 
            $result = $stmt -> fetchALl(PDO::FETCH_CLASS , $this -> getTargetClass()) ;
            
            return $result ;

        }catch(PDOException $e) {
            return false ;
        }

    }

    public function create() {
        $table = $this -> getTablename() ; 
        $column = $this -> getcolumns() ; 

        $columns = implode(', ' , $column)  ;
        $placeholder =  implode(', ' , array_fill(0 , count($column) , '?' )) ;
        

        $sql = 'INSERT INTO $table ($columns) VALUE ($placeholder)' ; 

        try {
            $pdo = Database::getInstance() -> getConnect() ;
            $stmt = $pdo -> prepare($sql) ;
            $stmt -> execute (array_values($column)) ; 
            
            $id = $pdo -> lastInsertId() ;

            return $id ; 

        }catch (PDOException $e) {
            return false ; 
        }



    }

    public function findbyid($id) {
        $table = $this -> getTablename() ; 
        
        $sql = 'SELECT * FROM $table WHERE id = ?' ;
        
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