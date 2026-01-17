<?php

namespace src\app\DAO;

use src\app\DAO\GenericDAO;
use src\config\Database;
use PDO;



class BookingDAO extends GenericDAO
{

    public function getTablename()
    {
        return 'bookings';
    }

    public function getbookingbystatus($id , $status)
    {
        $pdo = Database::getInstance()->getConnect();
        $sql = "SELECT b.booking_id,
                b.status,
                u.first_name AS sportif_first_name,
                u.last_name AS sportif_last_name,
                av.availabilities_date,
                av.start_time,
                av.end_time
                FROM bookings b 
                inner join users u on u.user_id = b.sportif_id 
                inner join availabilities av on b.availability_id = av.availability_id
                WHERE b.coach_id = ? AND b.status = ? ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id , $status]);

        $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($reponse);
        // exit;

        return $reponse;

    }

    public function getsportifbooking($id) {
        $pdo = Database::getInstance()->getConnect();
        $sql = "SELECT u.user_id , u.first_name , u.last_name , b.booking_id , b.status , a.availabilities_date , a.start_time , a.end_time , b.availability_id
                    FROM users u 
                    INNER JOIN bookings b ON u.user_id = b.coach_id 
                    INNER JOIN availabilities a ON a.availability_id = b.availability_id
                    WHERE b.sportif_id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id['sportif_id']]);

        $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($reponse);
        // exit;

        return $reponse;



    }



}