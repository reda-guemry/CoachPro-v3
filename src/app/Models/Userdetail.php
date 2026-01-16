<?php

namespace src\app\Models; 

class Userdetail
{
    private int $coach_id;
    private string $bio;
    private int $experience_year;
    private string $certification;
    private string $photo;

    // ===== GETTERS =====

    public function getCoachId(): int
    {
        return $this->coach_id;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getExperienceYear(): int
    {
        return $this->experience_year;
    }

    public function getCertification(): string
    {
        return $this->certification;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    // ===== SETTERS =====

    public function setCoachId(int $coach_id): void
    {
        $this->coach_id = $coach_id;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function setExperienceYear(int $experience_year): void
    {
        $this->experience_year = $experience_year;
    }

    public function setCertification(string $certification): void
    {
        $this->certification = $certification;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }
}
