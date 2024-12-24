<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyPromotionRequest;
use App\Http\Requests\BookingRequest;
use App\Services\Contracts\RoomBookingServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $roombookingService;
    public function __construct(RoomBookingServiceInterface $roombookingService)
    {
        $this->roombookingService = $roombookingService;
    }
    public function showBookingForm(Request $request)
    {
        
        try {
            $room_quantity = $request['room_quantity'];
            $check_in_out = [
                'available_from' => $request['check_in_date'],
                'available_to' => $request['check_out_date'],
            ];
            $rooms = [];
            foreach ($room_quantity as $roomId => $quantity) {
                $room_information = $this->roombookingService->getRoomByIdForBooking($roomId);
                $rooms[] = [
                    'roomId' => $roomId,
                    'quantity' => intval($quantity),
                    'room' => $room_information,
                    'destinations' => $room_information->destinations,
                    'variants' => $room_information->variants,
                ];
            }
            $dateBooking = $this->roombookingService->dateBooking($check_in_out);
            $price = $this->roombookingService->chargeMoney($rooms, $dateBooking);
            $review = $this->roombookingService->getReviewByRoom($roomId);
            $convenients = $this->roombookingService->getAllConvenientWithdestinationId($rooms[0]['room']);
            $location_address = $this->roombookingService->getLocationByIdDestinations();
            session([
                'rooms' => $rooms,
                'dateBooking' => $dateBooking,
                'review' => $review,
                'price' => $price
            ]);
            return view('client.booking.booking_detail', compact('rooms', 'dateBooking', 'price', 'review', 'convenients', 'location_address'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.room.error_booking'));
        }
    }

    public function informationPay(BookingRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $rooms = session('rooms');
            $dateBooking = session('dateBooking');
            $review = session('review');
            $price = session('price');
            $location_address = $this->roombookingService->getLocationByIdDestinations();
            $list_promotion = $this->roombookingService->getAllPromotionWithDestination();
            return view('client.booking.information', compact('rooms', 'dateBooking', 'review', 'request', 'price', 'location_address', 'list_promotion'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.room.error_booking'));
        }
    }
    public function applyPromotion(ApplyPromotionRequest $request)
    {
        try {
            $promotionCode = $request->input('promotion_code');
            session(['promotion_code' => $request->promotion_code]);
            // Gọi service để xử lý mã giảm giá
            $discountDetails = $this->roombookingService->applyPromotion($promotionCode);

            // Kiểm tra mã giảm giá hợp lệ
            if ($discountDetails['is_valid']) {
                return response()->json([
                    'success' => true,
                    'discount_amount' => $discountDetails['discount_amount'],
                    'new_total' => $discountDetails['new_total'],
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => __('content.booking.invalid_promotion_code')
                ], 422);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('content.booking.error_applying_promotion')
            ], 500);
        }
    }

    public function saveBooking(Request $request)
    {
        try {
            $booking = $this->roombookingService->saveBooking($request);
            $invoiceData = $this->roombookingService->prepareInvoiceData($booking);
            // dd($invoiceData);
            $this->roombookingService->BookingConfirmationMail($booking, $invoiceData);

            // Sau khi lưu thành công, chuyển hướng đến trang hóa đơn
            session()->put('booking_completed', true);
            session()->put('booking_id', $booking->id);
            return redirect()->route('booking.invoice', ['booking_id' => $booking->id])
                ->with('success', __('content.booking.Booking_Successful'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('content.room.error_booking'));
        }
    }
    public function showInvoice($booking_id)
    {
        session()->forget(['booking_completed', 'booking_id']);
        $booking = $this->roombookingService->getBookingById($booking_id);
        if ($booking) {
            // Chuyển đổi check_in và check_out sang Carbon
            $booking->check_in = Carbon::parse($booking->check_in)->startOfDay();
            $booking->check_out = Carbon::parse($booking->check_out)->startOfDay();

            // Giải mã JSON cho roomBookingDetails và guestDetails
            $roomBookingDetails = is_string($booking->room_booking_detail)
                ? json_decode($booking->room_booking_detail, true)
                : $booking->room_booking_detail;

            $guestDetails = is_string($booking->guest_details)
                ? json_decode($booking->guest_details, true)
                : $booking->guest_details;

            // Lấy thông tin mã giảm giá từ guestDetails
            $promotionDetails = $guestDetails['promotion_details'] ?? null;

            // Tính toán giá phòng cho khách sạn
            $totalOriginalPrice = 0; // Tổng giá gốc của tất cả các phòng
            $totalDiscountedPrice = 0; // Tổng giá sau giảm giá
            $totalTax = 0; // Tổng thuế
            $totalPrice = 0; // Tổng giá cuối cùng
            $numberOfNights = max($booking->check_in->diffInDays($booking->check_out), 1); // Số đêm đặt phòng (tối thiểu là 1)

            foreach ($roomBookingDetails as $room) {
                $originalPrice = $room['price_per_night'] ?? 0; // Giá phòng gốc mỗi đêm
                $quantity = $room['room_quantity'] ?? 1; // Số lượng phòng (mặc định là 1 nếu không có)

                // Tính giá sau giảm giá (nếu người dùng đăng nhập)
                $discountedPrice = auth()->check() ? $originalPrice * 0.9 : $originalPrice;

                // Tính tổng giá cho số đêm và số lượng phòng
                $totalRoomPrice = $originalPrice * $numberOfNights * $quantity;

                // Tính thuế 8% trên giá sau giảm giá
                $tax = $totalRoomPrice * 0.08;

                // Giá cuối cùng sau thuế
                $finalRoomPrice = $totalRoomPrice + $tax;

                // Cộng dồn các giá trị
                $totalOriginalPrice += $originalPrice * $numberOfNights * $quantity;
                $totalDiscountedPrice += $discountedPrice * $numberOfNights * $quantity;
                $totalTax += $tax;
                $totalPrice += $finalRoomPrice;
            }

            // Truyền dữ liệu vào view
            return view('client.booking.invoice', compact(
                'booking',
                'roomBookingDetails',
                'guestDetails',
                'promotionDetails',
                'totalOriginalPrice',
                'totalDiscountedPrice',
                'totalTax',
                'totalPrice',
                'numberOfNights'
            ));
        }
        return redirect()->route('home')->with('error', __('content.booking.error_invoice'));
    }


    public function vnp_payment(Request $request)
    {
        return $this->roombookingService->createPaymentVNP($request);
    }

    public function handleVNPAYCallback(Request $request)
    {
        return $this->roombookingService->returnPayment($request);
    }
}
