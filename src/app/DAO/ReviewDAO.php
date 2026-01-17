<?php

namespace src\app\DAO;

use src\app\DAO\GenericDAO;
use src\config\Database;
use PDO ; 



class ReviewDAO extends GenericDAO
{

    public function getTablename()
    {
        return 'reviews';

    }

    public function getreviewbycoach($id)
    {
        $pdo = Database::getInstance()->getConnect();
        $sql = "SELECT r.* , u.first_name , u.last_name 
            FROM reviews r 
            INNER JOIN bookings b ON r.booking_id = b.booking_id
            INNER JOIN users u ON b.sportif_id = u.user_id
            WHERE b.coach_id = ?" ;

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id['coach_id']]);

        $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($reponse);
        // exit;

        return $reponse;

    }



}