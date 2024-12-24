<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Services\Contracts\RoomBookingServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    protected $roombookingService;

    public function __construct(RoomBookingServiceInterface $roombookingService)
    {
        $this->roombookingService = $roombookingService;
    }

    public function showBookingForm($roomId, Request $request): JsonResponse
    {
        try {
            $room_quantity = $request->input('room_quantity');
            $room = $this->roombookingService->getRoomByIdForBooking($roomId);
            $dateBooking = $this->roombookingService->dateBooking();
            $review = $this->roombookingService->getReviewByRoom($roomId);

            return response()->json([
                'room' => $room,
                'dateBooking' => $dateBooking,
                'review' => $review,
                'room_quantity' => $room_quantity
            ], 200);
        } catch (\Exception $e) {
            Log::error("Lỗi khi hiển thị form đặt phòng: " . $e->getMessage());
            return response()->json(['error' => __('content.room.error_booking')], 500);
        }
    }

    public function informationPay(Request $request): JsonResponse
    {
        try {
            $room = $request->session()->get('room');
            $dateBooking = $request->session()->get('dateBooking');
            $review = $request->session()->get('review');

            return response()->json([
                'room' => $room,
                'dateBooking' => $dateBooking,
                'review' => $review,
                'request' => $request->all()
            ], 200);
        } catch (\Exception $e) {
            Log::error("Lỗi khi xử lý thông tin thanh toán: " . $e->getMessage());
            return response()->json(['error' => __('content.room.error_booking')], 500);
        }
    }

    public function saveBooking(Request $request): JsonResponse
    {
        try {
            $booking = $this->roombookingService->saveBooking($request);

            return response()->json(['success' => true, 'booking' => $booking], 201);
        } catch (\Exception $e) {
            Log::error("Lỗi khi lưu thông tin đặt phòng: " . $e->getMessage());
            return response()->json(['error' => __('content.room.error_booking')], 500);
        }
    }
}

