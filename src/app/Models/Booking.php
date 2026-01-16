<?php

namespace src\app\Models;

class Booking
{
    private $booking_id;
    private $sportif_id;
    private $coach_id;
    private $availability_id;
    private $status; 
    

    
    public function getBookingId()
    {
        return $this->booking_id;
    }

    public function getSportifId()
    {
        return $this->sportif_id;
    }

    public function getCoachId()
    {
        return $this->coach_id;
    }

    public function getAvailabilityId()
    {
        return $this->availability_id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    // Setters
    public function setBookingId($booking_id)
    {
        $this->booking_id = $booking_id;
    }

    public function setSportifId($sportif_id)
    {
        $this->sportif_id = $sportif_id;
    }

    public function setCoachId($coach_id)
    {
        $this->coach_id = $coach_id;
    }

    public function setAvailabilityId($availability_id)
    {
        $this->availability_id = $availability_id;
    }

}
