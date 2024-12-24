<div class="container mx-auto p-4" style="font-family: Arial, sans-serif;">
    <div class="max-w-screen-md mx-auto bg-white shadow-md rounded-lg border border-gray-200 p-8">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 style="font-size: 1.8rem; font-weight: bold; color: #1A202C; text-transform: uppercase;">
                {{ __('content.booking.invoice') }}
            </h1>
            <div style="color: #2B6CB0; font-weight: 600; font-size: 1.2rem;">
                {{ $roomBookingDetails[0]['destinations_name'] ?? 'N/A' }}
            </div>
            <p style="color: #718096; font-size: 0.9rem; margin-top: 0.5rem;">
                <strong>{{ __('content.booking.address') }}:</strong> 
                {{ $roomBookingDetails[0]['destinations_detailed_address'] ?? 'N/A' }},
                {{ $roomBookingDetails[0]['location_destination_address'] ?? 'N/A' }}
            </p>
        </div>

        <!-- Booking Details -->
        <div style="border-top: 3px solid #2B6CB0; padding-top: 1rem; margin-bottom: 2rem;">
            <h2 style="font-size: 1.2rem; font-weight: bold; color: #2B6CB0; margin-bottom: 1rem;">
                {{ __('content.booking.booking_details') }}
            </h2>
            <div style="display: flex; justify-content: space-between; color: #4A5568; font-size: 0.9rem;">
                <p><strong>{{ __('content.booking.check_in') }}:</strong> {{ $booking->check_in->format('d/m/Y') }}</p>
                <p><strong>{{ __('content.booking.check_out') }}:</strong> {{ $booking->check_out->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Room Details -->
        @foreach ($roomBookingDetails as $room)
            <div style="border-bottom: 1px solid #E2E8F0; padding-bottom: 1rem; margin-bottom: 2rem;">
                <h2 style="font-size: 1.2rem; font-weight: bold; color: #2B6CB0; border-bottom: 2px solid #2B6CB0; padding-bottom: 0.5rem;">
                    {{ __('content.booking.room_details') }}
                </h2>
                <div style="color: #4A5568; font-size: 0.9rem; line-height: 1.6;">
                    <p><strong>{{ __('content.booking.room_name') }}:</strong> {{ $room['room_name'] ?? 'N/A' }}</p>
                    <p><strong>{{ __('content.booking.room_quantity') }}:</strong> {{ $room['room_quantity'] ?? 'N/A' }}</p>
                    <p><strong>{{ __('content.booking.price_per_night') }}:</strong> VND {{ number_format($room['price_per_night'] ?? 0, 0, ',', '.') }}</p>
                    <p><strong>{{ __('content.booking.variant_name') }}:</strong> {{ $room['variants_name'] ?? 'N/A' }}</p>

                    <!-- Convenients -->
                    <p><strong>{{ __('content.booking.convenients') }}:</strong></p>
                    <ul style="list-style-type: disc; margin-left: 1.5rem; color: #4A5568;">
                        @foreach ($room['convenients'] ?? [] as $convenient)
                            <li>{{ $convenient }}</li>
                        @endforeach
                    </ul>

                    <p><strong>{{ __('content.booking.guest_quantity') }}:</strong> {{ $room['guest_quantity'] ?? 'N/A' }}</p>
                </div>
            </div>
        @endforeach

        <!-- Guest Details -->
        <div style="border-bottom: 1px solid #E2E8F0; padding-bottom: 1rem; margin-bottom: 2rem;">
            <h2 style="font-size: 1.2rem; font-weight: bold; color: #2B6CB0; border-bottom: 2px solid #2B6CB0; padding-bottom: 0.5rem;">
                {{ __('content.booking.guest_details') }}
            </h2>
            <div style="color: #4A5568; font-size: 0.9rem; line-height: 1.6;">
                <p><strong>{{ __('content.booking.guest_name') }}:</strong> {{ $guestDetails['last_name_user_account'] .' '. $guestDetails['first_name_user_account']  }}</p>
                <p><strong>{{ __('content.booking.email') }}:</strong> {{ $guestDetails['email_user_account'] }}</p>
                <p><strong>{{ __('content.booking.phone_number') }}:</strong> {{ $guestDetails['phone_number'] }}</p>
            </div>
        </div>

        <!-- Price Summary -->
        <div style="background-color: #F7FAFC; padding: 1.5rem; border: 1px solid #E2E8F0; border-radius: 0.5rem;">
            <div style="display: flex; justify-content: space-between; color: #4A5568; font-size: 0.9rem; border-bottom: 1px solid #E2E8F0; padding-bottom: 0.5rem;">
                <strong>{{ __('content.booking.number_of_nights') }}:</strong>
                <span>{{ $numberOfNights }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; color: #4A5568; font-size: 0.9rem; border-bottom: 1px solid #E2E8F0; padding-bottom: 0.5rem;">
                <strong>{{ __('content.booking.original_price') }}:</strong>
                <span>VND {{ number_format($totalOriginalPrice, 0, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; color: #48BB78; font-size: 0.9rem; border-bottom: 1px solid #E2E8F0; padding: 0.5rem 0;">
                <strong>{{ __('content.booking.tax') }} (8%):</strong>
                <span>+ VND {{ number_format($totalTax, 0, ',', '.') }}</span>
            </div>
            @if (auth()->user())
                <div style="display: flex; justify-content: space-between; color: #E53E3E; font-size: 0.9rem; border-bottom: 1px solid #E2E8F0; padding: 0.5rem 0;">
                    <strong>{{ __('content.booking.member_discount') }}:</strong>
                    <span>- VND {{ number_format($totalOriginalPrice - $totalDiscountedPrice, 0, ',', '.') }}</span>
                </div>
            @endif
            @if (isset($promotionDetails) && $promotionDetails['discount_amount'] > 0)
                <div style="display: flex; justify-content: space-between; color: #4A5568; font-size: 0.9rem; padding: 0.5rem 0;">
                    <strong>{{ __('content.booking.promotion_code') }}:</strong>
                    <span>{{ $promotionDetails['code'] }}</span>
                </div>
                @if ($promotionDetails['discount_type'] == 'percentage')
                    <div style="display: flex; justify-content: space-between; color: #4A5568; font-size: 0.9rem; padding: 0.5rem 0;">
                        <strong>{{ __('content.booking.discount_percentage') }}:</strong>
                        <span>{{ number_format($promotionDetails['discount_percentage'], 2) }}%</span>
                    </div>
                @endif
                <div style="display: flex; justify-content: space-between; color: #E53E3E; font-size: 0.9rem; padding: 0.5rem 0;">
                    <strong>{{ __('content.booking.discount_amount') }}:</strong>
                    <span>- VND {{ number_format($promotionDetails['discount_amount'], 0, ',', '.') }}</span>
                </div>
            @endif
            <div style="display: flex; justify-content: space-between; color: #E53E3E; font-size: 1.5rem; font-weight: bold; margin-top: 1rem;">
                <strong>{{ __('content.booking.total_price') }}:</strong>
                <span>VND {{ number_format($booking->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

    </div>
</div>
