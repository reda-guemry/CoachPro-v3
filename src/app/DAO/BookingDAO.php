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

    public function getbookings($id)
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
                WHERE b.coach_id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($reponse);
        // exit;

        return $reponse ; 

    }




}