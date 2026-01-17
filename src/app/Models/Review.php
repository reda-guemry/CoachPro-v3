<?php

class Review {
    private int $review_id;
    private int $booking_id;
    private string $commentaire;
    private int $rating; 


    // --- Getters ---

    public function getReviewId(): int {
        return $this->review_id;
    }

    public function getBookingId(): int {
        return $this->booking_id;
    }

    public function getCommentaire(): string {
        return $this->commentaire;
    }

    public function getRating(): int {
        return $this->rating;
    }

    // --- Setters ---

    public function setReviewId(int $review_id): void {
        $this->review_id = $review_id;
    }

    public function setBookingId(int $booking_id): void {
        $this->booking_id = $booking_id;
    }

    public function setCommentaire(string $commentaire): void {
        $this->commentaire = $commentaire;
    }

    public function setRating(int $rating): void {
        $this->rating = $rating;
    }
}