<?php

namespace App\Services\Contracts;

interface ReviewServiceInterface
{
    public function getFavoriteHomes();
    public function getAllReview();

    public function deleteReviewId($id, $reason);

    public function getReviewsByDestinationId($destinationId);

    // client
    public function getFavoriteDestinations();

    public function writeReviews($request);

    public function canUserReview($userId, $destinationId);
    public function calculateAverageRating($destinationId);
}
