<?php

namespace App\Services\Web;

use App\Events\NewBookingNotification;
use App\Mail\BookingConfirmationMail;
use App\Models\Destination;
use App\Models\Notification;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\RoomBooking;
use App\Models\RoomList;
use App\Models\RoomListBooking;
use App\Models\User;
use App\Models\Variant;
use App\Notifications\BookingSuccessfulNotification;
use App\Repositories\Contracts\PromotionRepository;
use App\Repositories\Contracts\ReviewRepository;
use App\Repositories\Contracts\RoomBookingRepository;
use App\Repositories\Contracts\RoomRepository;
use App\Services\Contracts\RoomBookingServiceInterface;
use App\Repositories\Contracts\UserRepository;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RoomBookingService implements RoomBookingServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }
    protected $roomBookingRepository;
    protected $roomRepository;
    protected $reviewRepository;
    protected $promotionRepository;
    protected $userRepository;

    public function __construct(
        RoomBookingRepository $roomBookingRepository,
        RoomRepository $roomRepository,
        ReviewRepository $reviewRepository,
        PromotionRepository $promotionRepository,
        UserRepository $userRepository
    ) {
        $this->roomBookingRepository = $roomBookingRepository;
        $this->roomRepository = $roomRepository;
        $this->reviewRepository = $reviewRepository;
        $this->promotionRepository = $promotionRepository;
        $this->userRepository = $userRepository;
    }

    public function getRoomByIdForBooking($id)
    {
        return $this->roomRepository->with(['destinations', 'variants'])->find($id);
    }
    public function getLocationByIdDestinations()
    {
        $destinationId = session('rooms', [])[0]['destinations']->id ?? null;

        return DB::table('location_destination')
            ->where('destination_id', $destinationId)
            ->value('address');
    }

    public function dateBooking($check_in_out)
    {
        $available_from_raw = $check_in_out['available_from'];
        $available_to_raw = $check_in_out['available_to'];

        $available_from = Carbon::parse($available_from_raw)->locale('vi')->isoFormat('ddd, D [tháng] M YYYY');
        $available_to = Carbon::parse($available_to_raw)->locale('vi')->isoFormat('ddd, D [tháng] M YYYY');;
        $available_from_save_db = Carbon::parse($available_from_raw)->setTime(14, 0, 0)->format('Y-m-d H:i:s');
        $available_to_save_db = Carbon::parse($available_to_raw)->setTime(12, 0, 0)->format('Y-m-d H:i:s');

        $checkInDate = Carbon::parse($available_from_raw);
        $checkOutDate = Carbon::parse($available_to_raw);
        $nightOfStay = $checkInDate->diffInDays($checkOutDate);

        return [
            'available_from' => $available_from,
            'available_to' => $available_to,
            'available_from_save_db' => $available_from_save_db,
            'available_to_save_db' => $available_to_save_db,
            'nightOfStay' => $nightOfStay
        ];
    }
    public function chargeMoney($rooms, $dateBooking)
    {
        $totalPrice = 0;
        $taxCalculation = 0.08;

        $originalPrices = [];
        $membershipDiscounts = [];
        $taxCalculationForRooms = [];
        $roomPrices = [];

        foreach ($rooms as $room) {
            $roomQuantity = $room['quantity'];

            // Chọn variant đầu tiên hoặc theo điều kiện cụ thể
            $selectedVariant = $room['variants'][0]; // Chọn variant đầu tiên
            // Hoặc theo điều kiện, ví dụ: giá thấp nhất
            // $selectedVariant = collect($room['variants'])->sortBy('pivot.price_per_night')->first();

            $pricePerNight = $selectedVariant->pivot->price_per_night; // Giá phòng trong 1 đêm
            $membershipDiscount = auth()->user() ? $pricePerNight * 0.1 : 0; // Tính giảm giá nếu đăng nhập
            $taxCalculationForRoom = $pricePerNight * $taxCalculation; // Thuế và phí trên giá phòng gốc

            $finalRoomPrice = ($pricePerNight + $taxCalculationForRoom - $membershipDiscount) * $roomQuantity * $dateBooking['nightOfStay'];

            $originalPrice = ($pricePerNight + $taxCalculationForRoom) * $roomQuantity * $dateBooking['nightOfStay'];
            $totalMembershipDiscount = $membershipDiscount * $roomQuantity * $dateBooking['nightOfStay'];
            $totalTaxCalculationForRoom = $taxCalculationForRoom * $roomQuantity * $dateBooking['nightOfStay'];
            $roomPrice = $pricePerNight * $roomQuantity * $dateBooking['nightOfStay'];

            // Lưu giá trị vào các mảng để tổng hợp
            $originalPrices[] = $originalPrice;
            $membershipDiscounts[] = $totalMembershipDiscount;
            $taxCalculationForRooms[] = $totalTaxCalculationForRoom;
            $roomPrices[] = $roomPrice;

            // Cộng dồn vào tổng giá cuối cùng
            $totalPrice += $finalRoomPrice;
        }

        return [
            'totalPrice' => $totalPrice,
            'originalPrices' => array_sum($originalPrices),
            'membershipDiscounts' => array_sum($membershipDiscounts),
            'taxCalculationForRooms' => array_sum($taxCalculationForRooms),
            'roomPrices' => array_sum($roomPrices),
        ];
    }


    public function getReviewByRoom($id)
    {
        $room = $this->roomRepository->with('destinations')->find($id);

        $destinationid = $room->destinations->id;

        $reviews = $this->reviewRepository->where('destination_id', $destinationid)->get();

        $totalReviews = $reviews->count();

        $totalRating = $reviews->sum('rating');

        $averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;

        return [
            'room' => $room,
            'totalReviews' => $totalReviews,
            'averageRating' => $averageRating
        ];
    }

    public function getAllConvenientWithdestinationId($room)
    {
        $destination_id = $room->destinations->id;
        $convenients = Destination::with('convenients')->find($destination_id);
        if ($convenients) {
            return $convenients->convenients;
        }
    }

    public function getAllPromotionWithDestination()
    {
        $rooms = session('rooms', []);
        $destination_id = $rooms[0]['destinations']->id;

        // Lấy user_id của người tạo khách sạn
        $user_id_destination = DB::table('user_destination')
            ->where('destination_id', $destination_id)
            ->pluck('user_id')
            ->first();

        // Lấy danh sách các mã giảm giá của người tạo khách sạn
        $promotion_ids_user = DB::table('promotion_user')
            ->where('user_id', $user_id_destination)
            ->pluck('promotion_id');

        // Lấy các mã giảm giá của người có role_id 3 hoặc 4
        $promotion_ids_role = DB::table('promotion_user')
            ->whereIn('user_id', function ($query) {
                $query->select('id')
                    ->from('users')
                    ->whereIn('role_id', [3, 4]);
            })
            ->pluck('promotion_id');


        // Kết hợp cả hai danh sách mã giảm giá
        $all_valid_promotions_ids = $promotion_ids_user->merge($promotion_ids_role)->unique();
        // Lấy danh sách tất cả các mã giảm giá hợp lệ từ các id trên
        $list_promotions = $this->promotionRepository
            ->whereIn('id', $all_valid_promotions_ids)
            ->get();

        // Lọc các mã giảm giá đã hết hạn hoặc hết số lượng
        $currentDate = Carbon::now();

        $filtered_promotions = $list_promotions->filter(function ($promotion) use ($currentDate) {
            // Kiểm tra ngày hết hạn
            $startDate = Carbon::parse($promotion->start_date);
            $endDate = Carbon::parse($promotion->end_date);

            if ($currentDate < $startDate || $currentDate > $endDate) {
                return false;
            }

            // Kiểm tra số lượng mã giảm giá còn lại
            if ($promotion->quantity !== null && $promotion->quantity <= 0) {
                return false;
            }

            return true;
        });

        // Trả về các mã giảm giá hợp lệ sau khi lọc
        return $filtered_promotions;
    }


    public function saveBooking($request)
    {
        $data = $request->all();

        $rooms = session('rooms', []);
        $rooms = array_values(array_filter($rooms, function ($room) {
            return intval($room['quantity']) > 0;
        }));
        $availableFrom = session('dateBooking.available_from_save_db');
        $availableTo = session('dateBooking.available_to_save_db');
        $allRoomBookingDetails = [];

        // lấy destination 
        $destinationId = $rooms[0]['destinations']->id;
        $destination = Destination::with(['images', 'convenients'])->find($destinationId);
        $destination_imageUrls = $destination->images->pluck('image')->toArray(); // Lấy danh sách URL của ảnh
        $convenients = $destination->convenients->pluck('name')->toArray(); // Lấy danh sách convenients

        // lấy user_id trong user_destination
        $user_id_destination = DB::table('user_destination')
            ->where('destination_id', $destinationId)
            ->pluck('user_id')
            ->first();

        // lấy location_destination
        $location_destination = DB::table('location_destination')
            ->where('destination_id', $destinationId)
            ->first();

        // lấy variants
        foreach ($rooms as $room) {
            $room_id = $room['roomId'];
            $room_quantity = $room['quantity'];

            // lấy variants
            $variant = Variant::where('id', $room['variants']->pluck('id')->first())->with('images')->first();
            $room_imageUrls = Room::with('images')->find($room_id)->images->pluck('image')->toArray();
            $variants_imageUrls = $variant->images->pluck('image')->toArray();

            // json booking detail
            $roomBookingDetail = [
                'room_name' => $room['room']->name,
                'room_id' => $room_id,
                'room_quantity' => $room_quantity,
                'room_image' => $room_imageUrls,

                'destinations_id' => $destinationId,
                'destinations_name' => $room['destinations']->name,
                'destinations_detailed_address' => $room['destinations']->detailed_address,
                'destinations_description' => $room['destinations']->description,
                'destinations_images' => $destination_imageUrls,

                'variants_id' => $variant->id,
                'variants_name' => $variant->name,
                'variants_description' => $variant->description,
                'variants_image' => $variants_imageUrls,

                'location_destination_address' => $location_destination->address,
                'location_destination_district_code' => $location_destination->district_code,
                'location_destination_ward_code' => $location_destination->ward_code,
                'location_destination_description' => $location_destination->description,

                'convenients' => $convenients,

                'price_per_night' => intval($room['variants']->first()->pivot->price_per_night),
                'available_from' => $availableFrom,
                'available_to' => $availableTo,
                'guest_quantity' => $room['room']->guest_quantity,
            ];
            $allRoomBookingDetails[] = $roomBookingDetail;
        }

        // Kiểm tra nếu có mã giảm giá được áp dụng
        $promotionDetails = null;
        if (session()->has('promotion_code')) {
            $totalPrice = session('totalPrice', $data['total_price']);

            $promotionDetails = [
                'code' => session('promotion_code'),
                'discount_amount' => session('promotion_discount_amount'),
                'discount_type' => session('promotion_discount_type'),
                'discount_percentage' => session('promotion_discount_percentage'),
                'totalPrice' => $totalPrice,
            ];
        }

        // json guest detail
        $guestDetails = [
            'last_name_user_account' => $data['last_name'],
            'first_name_user_account' => $data['first_name'],
            'email_user_account' => $data['email'],
            'phone_number' => $data['phone_number'],
            'email_guest' => $data['email_guest'],
            'full_name_guest' => $data['full_name_guest'],
            'time_check_in' => $data['time_check_in'],
            'transaction_id' => $data['transaction_id'],
            'payer_email' => $data['payer_email'],
            'promotion_details' => $promotionDetails, // Chỉ thêm chi tiết mã giảm giá nếu có áp dụng
        ];

        DB::beginTransaction();
        try {
            // Thực hiện toàn bộ các thao tác lưu
            $roomBooking = $this->roomBookingRepository->create([
                'check_in' => $availableFrom,
                'check_out' => $availableTo,
                'total_price' => $data['total_price'],
                'take_note' => $data['take_note'],
                'user_id' => $data['user_id'],
                'room_booking_detail' => json_encode($allRoomBookingDetails),
                'guest_details' => json_encode($guestDetails),
            ]);

            DB::table('user_room_booking')->insert([
                'user_id' => $user_id_destination,
                'booking_id' => $roomBooking->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            foreach ($rooms as $room) {
                $room_id = $room['roomId'];
                $room_quantity = $room['quantity'];

                // Lấy danh sách các phòng đã thuê
                $bookedRoomListIds = RoomListBooking::join('room_lists', 'room_lists.id', '=', 'room_list_booking.room_list_id')
                    ->where('room_lists.room_id', $room_id)
                    ->where('room_list_booking.status', ACTIVE)
                    ->where(function ($query) use ($availableFrom, $availableTo) {
                        $query->whereBetween('room_list_booking.available_from', [$availableFrom, $availableTo])
                            ->orWhereBetween('room_list_booking.available_to', [$availableFrom, $availableTo])
                            ->orWhere(function ($query) use ($availableFrom, $availableTo) {
                                $query->where('room_list_booking.available_from', '<=', $availableFrom)
                                    ->where('room_list_booking.available_to', '>=', $availableTo);
                            });
                    })
                    ->pluck('room_lists.id')
                    ->toArray();

                // Lấy các phòng còn trống
                $availableRooms = RoomList::where('room_id', $room_id)
                    ->whereNotIn('id', $bookedRoomListIds)
                    ->take($room_quantity)
                    ->lockForUpdate() // Khóa dữ liệu để tránh ghi đè
                    ->get();

                if ($availableRooms->count() >= $room_quantity) {
                    foreach ($availableRooms as $availableRoom) {
                        RoomListBooking::create([
                            'room_list_id' => $availableRoom->id,
                            'booking_id' => $roomBooking->id,
                            'available_from' => $availableFrom,
                            'available_to' => $availableTo,
                            'status' => ACTIVE,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                } else {
                    throw new \Exception('Không đủ phòng trống để đặt!');
                }
            }

            // Kiểm tra và giảm số lượng mã giảm giá
            if (!empty($request->promotion_code)) {
                $this->promotionRepository->where('code', $request->promotion_code)->decrement('quantity');
            }

            // Thêm thông báo
            $notification = Notification::create([
                'user_id' => $user_id_destination,
                'message' => __('content.navbar.notification'),
                'full_name' => $data['first_name'] . ' ' . $data['last_name'],
                'read' => false,
            ]);

            event(new NewBookingNotification($notification, $user_id_destination));

            DB::commit();
            return $roomBooking;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function applyPromotion($promotionCode)
    {
        $promotion = $this->promotionRepository->where('code', $promotionCode)->first();
        if (!$promotion) {
            return ['is_valid' => false];
        }

        $price = session('price', []);
        $totalPrice = $price['totalPrice'];

        // Tính toán số tiền giảm giá
        $discountAmount = 0;
        if ($promotion->discount_type === 'percentage') {
            $discountAmount = ($promotion->discount_percentage / 100) * $totalPrice;
        } elseif ($promotion->discount_type === 'amount') {
            $discountAmount = $promotion->discount_amount;
        }

        // Đảm bảo số tiền giảm không vượt quá giá phòng
        $discountAmount = min($discountAmount, $totalPrice);
        $newTotal = $totalPrice - $discountAmount;
        $newTotal = max($newTotal, 0);

        // Lưu chi tiết mã giảm giá vào session
        session([
            'promotion_code' => $promotion->code,
            'promotion_discount_amount' => $discountAmount,
            'promotion_discount_type' => $promotion->discount_type,
            'promotion_discount_percentage' => $promotion->discount_percentage,
            'totalPrice' => $totalPrice,
            'new_total' => $newTotal,
        ]);

        return [
            'is_valid' => true,
            'totalPrice' => $totalPrice,
            'discount_amount' => $discountAmount,
            'new_total' => $newTotal,
        ];
    }


    public function getUserBookings($request)
    {
        $userId = auth()->id();
        if (!$userId) {
            return null;
        }
        $filters = [];
        if (!empty($request['keyword'])) {
            $filters['keyword'] = $request['keyword'];
        }
        if (!empty($request['roomType'])) {
            $filters['roomType'] = $request['roomType'];
        }
        if (!empty($request['transaction_id'])) {
            $filters['transaction_id'] = $request['transaction_id'];
        }
        if (!empty($request['bookerName'])) {
            $filters['bookerName'] = $request['bookerName'];
        }
        if (!empty($request['phoneNumber'])) {
            $filters['phoneNumber'] = $request['phoneNumber'];
        }
        if (!empty($request['status'])) {
            $filters['status'] = $request['status'];
        }
        $roomBookingQuery = $this->roomBookingRepository->buildQuery(RoomBooking::query(), $filters);
        $roomBooking = $roomBookingQuery->orderBy('updated_at', 'desc')
            ->paginate(PAGINATE_MAX_RECORD)
            ->withQueryString();

        return $roomBooking;
    }

    public function BookingConfirmationMail($booking, $invoiceData)
    {
        $guestDetails = $booking->guest_details;
        $email = $guestDetails['email_user_account'];
        Mail::to($email)->send(new BookingConfirmationMail($booking, $invoiceData));
    }
    public function prepareInvoiceData($booking)
    {
        $booking->check_in = Carbon::parse($booking->check_in)->startOfDay();
        $booking->check_out = Carbon::parse($booking->check_out)->startOfDay();

        $roomBookingDetails = is_string($booking->room_booking_detail)
            ? json_decode($booking->room_booking_detail, true)
            : $booking->room_booking_detail;

        $guestDetails = is_string($booking->guest_details)
            ? json_decode($booking->guest_details, true)
            : $booking->guest_details;

        $promotionDetails = $guestDetails['promotion_details'] ?? null;

        $totalOriginalPrice = 0;
        $totalDiscountedPrice = 0;
        $totalTax = 0;
        $totalPrice = 0;
        $numberOfNights = max($booking->check_in->diffInDays($booking->check_out), 1);

        foreach ($roomBookingDetails as $room) {
            $originalPrice = $room['price_per_night'] ?? 0;
            $quantity = $room['room_quantity'] ?? 1;
            $discountedPrice = auth()->check() ? $originalPrice * 0.9 : $originalPrice;

            $totalRoomPrice = $discountedPrice * $numberOfNights * $quantity;
            $tax = $totalRoomPrice * 0.08;
            $finalRoomPrice = $totalRoomPrice + $tax;

            $totalOriginalPrice += $originalPrice * $numberOfNights * $quantity;
            $totalDiscountedPrice += $discountedPrice * $numberOfNights * $quantity;
            $totalTax += $tax;
            $totalPrice += $finalRoomPrice;
        }

        return [
            'roomBookingDetails' => $roomBookingDetails,
            'guestDetails' => $guestDetails,
            'totalOriginalPrice' => $totalOriginalPrice,
            'totalDiscountedPrice' => $totalDiscountedPrice,
            'totalTax' => $totalTax,
            'totalPrice' => $totalPrice,
            'numberOfNights' => $numberOfNights,
            'promotionDetails' => $promotionDetails
        ];
    }

    public function getBookingById($id)
    {
        return $this->roomBookingRepository->find($id);
    }

    public function createPaymentVNP($request)
    {
        // $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = route('vnpay.callback');
        // $vnp_TmnCode = "O03OOQLP"; // Mã website tại VNPAY 
        // $vnp_HashSecret = "NUGLR0C944DO2BLQMFRE044ZVUOJFQPG"; // Chuỗi bí mật

        // $vnp_TxnRef = time(); // Mã đơn hàng
        // $vnp_OrderInfo = 'Thanh Toan Don Hang';
        // $vnp_OrderType = 'billpayment';
        // $vnp_Amount = $request['total_price'] * 100;
        // $vnp_Locale = 'vn';
        // $vnp_BankCode = 'NCB';
        // $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        // // Tạo dữ liệu input
        // $inputData = [
        //     "vnp_Version" => "2.1.0",
        //     "vnp_TmnCode" => $vnp_TmnCode,
        //     "vnp_Amount" => $vnp_Amount,
        //     "vnp_Command" => "pay",
        //     "vnp_CreateDate" => date('YmdHis'),
        //     "vnp_CurrCode" => "VND",
        //     "vnp_IpAddr" => $vnp_IpAddr,
        //     "vnp_Locale" => $vnp_Locale,
        //     "vnp_OrderInfo" => $vnp_OrderInfo,
        //     "vnp_OrderType" => $vnp_OrderType,
        //     "vnp_ReturnUrl" => $vnp_Returnurl,
        //     "vnp_TxnRef" => $vnp_TxnRef,
        // ];

        // if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        //     $inputData['vnp_BankCode'] = $vnp_BankCode;
        // }

        // // Sắp xếp và tạo hashData
        // ksort($inputData);
        // $hashData = urldecode(http_build_query($inputData)); // Tạo chuỗi hash nhất quán

        // // Tính toán hash
        // if ($vnp_HashSecret) {
        //     $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        //     $inputData['vnp_SecureHash'] = $vnpSecureHash; // Thêm vào URL
        // }

        // // Tạo URL redirect
        // $vnp_Url = $vnp_Url . "?" . http_build_query($inputData);

        // return redirect($vnp_Url);
    }
    // private function buildCleanHashData(array $inputData): string
    // {
    //     // Tạo chuỗi query từ inputData
    //     $rawHashData = http_build_query($inputData);

    //     // Loại bỏ ký tự xuống dòng, khoảng trắng không mong muốn
    //     $cleanHashData = str_replace(["\n", "\r"], '', trim(urldecode($rawHashData)));

    //     return $cleanHashData;
    // }

    public function returnPayment($request)
    {
        // $vnp_HashSecret = "NUGLR0C944DO2BLQMFRE044ZVUOJFQPG"; // Chuỗi bí mật
        // $inputData = $request->all();

        // // Lấy SecureHash từ request
        // $vnp_SecureHash = $inputData['vnp_SecureHash'];
        // unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']); // Loại bỏ để tránh ảnh hưởng hash

        // // Sắp xếp dữ liệu
        // ksort($inputData);
        // $hashData = urldecode(http_build_query($inputData)); // Tạo chuỗi hash nhất quán

        // // Tính toán hash
        // $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // // Debug
        // dd([
        //     'hashData' => $hashData,
        //     'secureHash' => $secureHash,
        //     'vnp_SecureHash' => $vnp_SecureHash,
        //     'inputData' => $inputData,
        // ]);

        // // So sánh hash
        // if ($secureHash === $vnp_SecureHash) {
        //     if ($inputData['vnp_ResponseCode'] === '00') {
        //         // Thành công
        //         return redirect()->route('booking.invoice', $inputData['vnp_TxnRef'])
        //             ->with('success', 'Thanh toán thành công!');
        //     } else {
        //         // Lỗi từ VNPAY
        //         return redirect()->route('booking.details')
        //             ->with('error', 'Thanh toán thất bại!');
        //     }
        // } else {
        //     // Lỗi hash
        //     return redirect()->route('booking.details')
        //         ->with('error', 'Dữ liệu không hợp lệ!');
        // }
    }
}
