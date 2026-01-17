<?php

namespace src\app\DAO\user;

use src\app\DAO\GenericDAO;
use src\config\Database;
use PDO  ;



class UserDAO extends GenericDAO
{


    public function getTablename()
    {
        return 'users';
    }

    public function getcoaches()
    {
        $pdo = Database::getInstance()->getConnect();

        $check = $pdo-> query("SELECT u.* , c.* from users u  inner join user_details c on u.user_id = c.coach_id");

        $result = $check->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $evrycoash) {
            $idcoash = $evrycoash["coach_id"];
            $check = $pdo->query("SELECT s.sport_name 
                                                    FROM user_details c
                                                    INNER JOIN coach_sport cs ON cs.coach_id = c.coach_id 
                                                    INNER JOIN sports s ON cs.sport_id = s.sport_id 
                                                    WHERE c.coach_id = $idcoash");
            $sports = $check->fetchAll(PDO::FETCH_ASSOC);
            $evrycoash["sports"] = $sports;
            $allcoach[] = $evrycoash;
        }

        // var_dump( $allcoach);
        // exit;

        return $allcoach;



    }


}