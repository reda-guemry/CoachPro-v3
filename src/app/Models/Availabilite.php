<?php 
namespace src\app\Models;

class Availabilite
{
    private int $availability_id;
    private int $coach_id;
    private string $availabilities_date;
    private string $start_time;
    private string $end_time;
    private string $status;

    /* =======================
       GETTERS
    ======================= */

    public function getAvailabilityId(): int
    {
        return $this->availability_id;
    }

    public function getCoachId(): int
    {
        return $this->coach_id;
    }

    public function getAvailabilitesDate(): string
    {
        return $this->availabilities_date;
    }

    public function getStartTime(): string
    {
        return $this->start_time;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /* =======================
       SETTERS
    ======================= */

    public function setAvailabilityId(int $availability_id): self
    {
        $this->availability_id = $availability_id;
        return $this;
    }
    

    public function setCoachId(int $coach_id): self
    {
        $this->coach_id = $coach_id;
        return $this;
    }

    public function setAvailabilitesDate(string $availabilities_date): self
    {
        $this->availabilities_date = $availabilities_date;
        return $this;
    }

    public function setStartTime(string $start_time): self
    {
        $this->start_time = $start_time;
        return $this;
    }

    public function setEndTime(string $end_time): self
    {
        $this->end_time = $end_time;
        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }
}
