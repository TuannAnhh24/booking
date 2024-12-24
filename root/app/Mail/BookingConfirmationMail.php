<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use SerializesModels;

    public $booking;
    public $invoiceData;

    public function __construct($booking, $invoiceData)
    {
        $this->booking = $booking;
        $this->invoiceData = $invoiceData;
    }

    public function build()
    {
        // Truyền dữ liệu đầy đủ vào view
        return $this->subject(__('content.booking.Confirm_booking'))
            ->view('client.booking.bookingmail')
            ->with([
                'roomBookingDetails' => $this->invoiceData['roomBookingDetails'] ?? [],
                'guestDetails' => $this->invoiceData['guestDetails'] ?? [],
                'totalOriginalPrice' => $this->invoiceData['totalOriginalPrice'] ?? 0,
                'totalDiscountedPrice' => $this->invoiceData['totalDiscountedPrice'] ?? 0,
                'totalTax' => $this->invoiceData['totalTax'] ?? 0,
                'totalPrice' => $this->invoiceData['totalPrice'] ?? 0,
                'numberOfNights' => $this->invoiceData['numberOfNights'] ?? 0,
                'promotionDetails' => $this->invoiceData['promotionDetails'] ?? null,
                'booking' => $this->booking,
            ]);
    }
}
