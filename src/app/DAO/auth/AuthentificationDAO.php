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

            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->getTargetClass());

            $result = $stmt -> fetch() ;

            return $result ;

        }catch (PDOException $e ) {
            return false ;
        }
    }


    
}