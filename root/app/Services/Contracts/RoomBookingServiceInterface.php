<?php

namespace App\Services\Contracts;

interface RoomBookingServiceInterface
{
    public function getRoomByIdForBooking($id);
    public function dateBooking($check_in_out);
    public function chargeMoney($rooms, $dateBooking);
    public function getReviewByRoom($id);
    public function saveBooking($request);
    public function applyPromotion($promotionCode);
    public function getAllConvenientWithdestinationId($room);
    public function getUserBookings($request);
    public function getBookingById($id);
    public function getLocationByIdDestinations();
    public function createPaymentVNP( $request);
    public function returnPayment($request);
    public function getAllPromotionWithDestination();
    public function BookingConfirmationMail($booking,$invoiceData);
    public function prepareInvoiceData($booking);
}
