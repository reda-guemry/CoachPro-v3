<?php 

namespace src\app\DAO\auth;

use PDOException;
use src\app\DAO\GenericDAO ;
use src\config\Database; 
use PDO ; 



class AuthentificationDAO extends GenericDAO {

    public function getTablename() {
        return 'users' ;
    }

    public function findByEmail($email) {
        $table = $this -> getTablename() ; 
        $sql = "SELECT * FROM $table WHERE email = ? " ;

        try {
            $pdo = Database::getInstance() -> getConnect() ; 
            $stmt = $pdo -> prepare($sql) ; 
            $stmt -> execute([$email]) ; 

            $result = $stmt -> fetch(PDO::FETCH_ASSOC) ;

            return $result ;

        }catch (PDOException $e ) {
            return false ;
        }
    }


    
}