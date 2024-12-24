@extends('client.layouts.master-layout')
@section('content')
    @include('client.layouts.header')

    <div class="container mx-auto p-4">
        <div class="max-w-screen-md mx-auto bg-white shadow-lg rounded-lg border-2 border-gray-200 p-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 uppercase tracking-wide">{{ __('content.booking.invoice') }}
                </h1>
                <div class="text-blue-700 font-semibold text-lg">{{ $roomBookingDetails[0]['destinations_name'] ?? 'N/A' }}
                </div>
                <p class="text-gray-600 text-sm">
                    <strong>{{ __('content.booking.address') }}: </strong>
                    {{ $roomBookingDetails[0]['destinations_detailed_address'] ?? 'N/A' }},
                    {{ $roomBookingDetails[0]['location_destination_address'] ?? 'N/A' }}
                </p>
            </div>

            <!-- Booking Details -->
            <div class="border-t-4 border-blue-700 py-4 mb-6">
                <h2 class="text-xl font-bold text-blue-700 mb-3">{{ __('content.booking.booking_details') }}</h2>
                <div class="flex justify-between text-gray-700 text-sm">
                    <p><strong>{{ __('content.booking.check_in') }}:</strong> {{ $booking->check_in->format('d/m/Y') }}
                    </p>
                    <p><strong>{{ __('content.booking.check_out') }}:</strong>
                        {{ $booking->check_out->format('d/m/Y') }}</p>
                </div>
            </div>

            <!-- Room Details -->
            @foreach ($roomBookingDetails as $room)
                <div class="border-b border-gray-300 pb-4 mb-6">
                    <h2 class="text-xl font-bold text-blue-700 mb-3 border-b-2 border-blue-700 pb-2">
                        {{ __('content.booking.room_details') }}</h2>
                    <div class="text-gray-700 text-sm space-y-2">
                        <p><strong>{{ __('content.booking.room_name') }}:</strong> {{ $room['room_name'] ?? 'N/A' }}</p>
                        <p><strong>{{ __('content.booking.room_quantity') }}:</strong>
                            {{ $room['room_quantity'] ?? 'N/A' }}</p>
                        <p><strong>{{ __('content.booking.price_per_night') }}:</strong> VND
                            {{ number_format($room['price_per_night'] ?? 0, 0, ',', '.') }}</p>
                        <p><strong>{{ __('content.booking.variant_name') }}:</strong>
                            {{ $room['variants_name'] ?? 'N/A' }}</p>

                        <!-- Convenients -->
                        <p><strong>{{ __('content.booking.convenients') }}:</strong></p>
                        <ul class="list-disc ml-6 text-gray-700">
                            @foreach ($room['convenients'] ?? [] as $convenient)
                                <li>{{ $convenient }}</li>
                            @endforeach
                        </ul>

                        <p><strong>{{ __('content.booking.guest_quantity') }}:</strong>
                            {{ $room['guest_quantity'] ?? 'N/A' }}</p>
                        {{-- <p><strong>{{ __('content.booking.variant_description') }}:</strong> {{ $room['variants_description'] ?? 'N/A' }}</p> --}}
                    </div>
                </div>
            @endforeach

            <!-- Guest Details -->
            <div class="border-b border-gray-300 pb-4 mb-6">
                <h2 class="text-xl font-bold text-blue-700 mb-3 border-b-2 border-blue-700 pb-2">
                    {{ __('content.booking.guest_details') }}</h2>
                <div class="text-gray-700 text-sm space-y-2">
                    <p><strong>{{ __('content.booking.guest_name') }}:</strong>
                        {{ $guestDetails['last_name_user_account'] }}
                        {{ $guestDetails['first_name_user_account'] }}
                    </p>

                    <p><strong>{{ __('content.booking.email') }}:</strong>
                        {{ $guestDetails['email_user_account'] ?? 'N/A' }}</p>
                    <p><strong>{{ __('content.booking.phone_number') }}:</strong>
                        {{ $guestDetails['phone_number'] ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Price Summary Section -->
            <div class="text-right mt-8 bg-gray-50 p-6 rounded-lg border border-gray-300 shadow-sm">
                <!-- Hiển thị tổng số đêm -->
                <div class="flex justify-between text-ml text-gray-700 border-b pb-2">
                    <strong>{{ __('content.booking.number_of_nights') }}:</strong>
                    <span class="text-gray-600">{{ $numberOfNights }}</span>
                </div>
                <!-- Hiển thị tổng giá gốc -->
                <div class="flex justify-between text-ml text-gray-700 border-b pb-2">
                    <strong>{{ __('content.booking.original_price') }}:</strong>
                    <span class="text-gray-600">VND {{ number_format($totalOriginalPrice, 0, ',', '.') }}</span>
                </div>
                <!-- Hiển thị tổng thuế -->
                <div class="flex justify-between text-ml text-gray-700 border-b py-2">
                    <strong>{{ __('content.booking.tax') }} (8%):</strong>
                    <span class="text-green-600">+ VND {{ number_format($totalTax, 0, ',', '.') }}</span>
                </div>
                <!-- Hiển thị tổng giảm giá -->
                @if (auth()->user())
                    <div class="flex justify-between text-ml text-gray-700 border-b py-2">
                        <strong>{{ __('content.booking.member_discount') }}:</strong>
                        <span class="text-red-500 ">- VND
                            {{ number_format($totalOriginalPrice - $totalDiscountedPrice, 0, ',', '.') }}</span>
                    </div>
                @endif
                <!-- Hiển thị thông tin mã giảm giá -->
                @if (isset($promotionDetails) && $promotionDetails['discount_amount'] > 0)
                    <!-- Mã giảm giá -->
                    <div class="flex justify-between text-ml text-gray-700 border-b py-2">
                        <strong>{{ __('content.booking.promotion_code') }}:</strong>
                        <span>{{ $promotionDetails['code'] }}</span>
                    </div>

                    <!-- Loại giảm giá (nếu có) -->
                    @if ($promotionDetails['discount_type'] == 'percentage')
                        <div class="flex justify-between text-ml text-gray-700 border-b py-2">
                            <strong>{{ __('content.booking.discount_percentage') }}:</strong>
                            <span>{{ number_format($promotionDetails['discount_percentage'], 2) }}%</span>
                        </div>
                    @endif
                    <!-- Số tiền giảm giá -->
                    <div class="flex justify-between text-ml text-gray-700 border-b py-2">
                        <strong>{{ __('content.booking.discount_amount') }}:</strong>
                        <span class="text-red-500">
                            - VND {{ number_format($promotionDetails['discount_amount'], 0, ',', '.') }}
                        </span>
                    </div>
                @endif
                <!-- Hiển thị tổng giá cuối cùng -->
                <div class="flex justify-between text-2xl font-bold text-red-600 py-4">
                    <strong>{{ __('content.booking.total_price') }}:</strong>
                    <span>VND {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>

                <!-- Nút quay lại -->
                <div class="mt-4">
                    <a href="{{ route('home') }}"
                        class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-full shadow-lg transition duration-300">
                        {{ __('content.booking.go_back') }}
                    </a>
                </div>
            </div>


        </div>
        @include('client.layouts.footer')
    @endsection
