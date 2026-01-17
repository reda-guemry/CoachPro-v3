<?php

namespace src\app\Models;

class Sport {
    private int $sport_id;
    private string $sport_name;

    // --- Getters ---
    public function getSportId(): int {
        return $this->sport_id;
    }

    public function getSportName(): string {
        return $this->sport_name;
    }

    // --- Setters ---
    public function setSportId(int $sport_id): void {
        $this->sport_id = $sport_id;
    }

    public function setSportName(string $sport_name): void {
        $this->sport_name = $sport_name;
    }
}