@extends('client.layouts.master-layout')
@section('content')
    @include('client.layouts.header')
    <!-- main -->
    <div class="container mx-auto p-4 max-w-screen-lg">
        <div class="lg:container mx-auto px-3 pt-6 mb-4 max-w-6xl">
            <div class="flex justify-between items-center space-x-4">
                <div class="flex items-center">
                    <div class="flex items-center size-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 rounded-full bg-sky-600 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <p class="ml-2 font-bold text-sm">{{ __('content.booking.you_choose') }}</p>
                </div>
                <div class="border-t-2 border-black flex-grow"></div>
                <!-- Step 2 -->
                <div class="flex items-center">
                    <div class="flex items-center size-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 rounded-full bg-sky-600 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <p class="ml-2 font-bold text-sm">{{ __('content.booking.details_about_you') }}</p>
                </div>
                <!-- Line Separator -->
                <div class="border-t-2 border-black flex-grow"></div>
                <!-- Step 3 -->
                <div class="flex items-center">
                    <div class="flex items-center size-6">
                        <div class="flex items-center justify-center size-6 rounded-full bg-sky-600 text-white">
                            3
                        </div>
                    </div>
                    <p class="ml-2 font-bold text-sm">{{ __('content.booking.final_step') }}</p>
                </div>
            </div>
        </div>

        <div class="container mx-auto grid grid-cols-12 min-w-screen-lg">
            <aside class="col-span-4 p-4 pt-6 px-3">
                <div>
                    <div class="border rounded-md p-4 space-y-4">
                        <div class="flex items-center">
                            <p class="text-base mr-2">{{ __('content.booking.hotel') }}</p>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold">{{ $rooms[0]['destinations']->name }}</h2>
                        </div>

                        <div>
                            <p class="text-base">
                                {{ $rooms[0]['destinations']->detailed_address }} {{ $location_address }}
                            </p>
                        </div>

                        <div class="flex flex-row items-center my-2">
                            <div class="mr-2">
                                <span
                                    class="inline-block rounded-md text-base w-6 h-6 items-center justify-center border-2 border-blue-700 bg-blue-700 basis-1/4">
                                    <p class="text-center text-sm font-normal text-white">
                                        {{ $review['averageRating'] }}
                                    </p>
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <p class="text-base">
                                    @if ($review['averageRating'] >= 9)
                                        {{ __('content.booking.Excellence') }}
                                    @elseif($review['averageRating'] >= 8)
                                        {{ __('content.booking.Good') }}
                                    @elseif($review['averageRating'] >= 7)
                                        {{ __('content.booking.pretty_good') }}
                                    @elseif($review['averageRating'] >= 6)
                                        {{ __('content.booking.medium') }}
                                    @else
                                        {{ __('content.booking.below_average') }}
                                    @endif
                                </p>
                                <span class="text-base mx-1">.</span>
                                <p class="text-base">{{ $review['totalReviews'] }} {{ __('content.booking.Evaluate') }}
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="border rounded-md p-4 mt-4 space-y-4">
                        <div>
                            <h2 class="text-xl font-bold">
                                {{ __('content.booking.your_booking_details') }}
                            </h2>
                        </div>

                        <div>
                            <div class="flex flex-row mt-4 justify-between">
                                <div class="flex-1 pr-4 border-r-2">
                                    <div class="mb-1">
                                        <p class="text-sm font-medium">
                                            {{ __('content.booking.check_in') }}
                                        </p>
                                    </div>
                                    <label class="text-base font-bold">
                                        {{ $dateBooking['available_from'] }}
                                    </label><br />
                                    <span class="text-sm font-light">{{ __('content.booking.form') }} 14:00</span>
                                </div>
                                <div class="flex-1 pl-4">
                                    <div class="mb-1">
                                        <p class="text-sm font-medium">
                                            {{ __('content.booking.check_out') }}
                                        </p>
                                    </div>
                                    <label class="text-base font-bold">{{ $dateBooking['available_to'] }}</label><br />
                                    <span class="text-sm font-light">{{ __('content.booking.to') }} 12:00</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div>
                                    <p class="text-sm">
                                        {{ __('content.booking.total_length_of_stay') }}:
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-bold mt-1">{{ $dateBooking['nightOfStay'] }}
                                        {{ __('content.booking.night') }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="mx-1 border-t-2 border-gray-300"></div>
                            </div>
                        </div>
                        <div>
                            <p class="text-gray-700 mt-2">{{ __('content.booking.you_have_selected') }}
                            </p>
                            @php
                                // Tính tổng số lượng phòng
                                $totalQuantity = array_sum(array_column($rooms, 'quantity'));
                            @endphp
                            <div>
                                <button onclick="toggleDropdownInfo()" class="flex items-center w-full">
                                    <span class="flex-1 text-left rtl:text-right whitespace-nowrap font-bold text-black">
                                        {{ $totalQuantity }}x
                                        {{ __('content.booking.room_for') }}
                                        {{ $rooms[0]['room']->guest_quantity }}
                                        {{ __('content.booking.adult') }}
                                    </span>
                                    <svg id="arrow-icon" class="w-3 h-3 ml-2 transition-transform duration-300"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <!-- drop-down -->
                                <ul id="dropdownInfo"
                                    class="hidden space-y-0.5 transition-all duration-500 ease-in-out transform origin-top">
                                    @foreach ($rooms as $room)
                                        @if ($room['quantity'] > 0)
                                            <li class="mt-2">
                                                <div
                                                    class="w-full p-2 text-gray-900 bg-gray-100 transition duration-75 rounded-lg pl-4 group">
                                                    <div>
                                                        <span class="block text-black">{{ $room['quantity'] }}x
                                                            {{ $room['room']->name }}</span>
                                                        <span class="block text-base mt-1 text-black">
                                                            {{ $room['room']->guest_quantity }}
                                                            {{ __('content.booking.adult') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('hotel-details', ['id' => $rooms[0]['destinations']->id]) }}"
                                    class="text-sm fornt-semibold text-blue-500">{{ __('content.booking.Change_your_choice') }}</a>
                            </div>
                        </div>
                    </div>

                    <section class="mt-4 border rounded-md space-y-2">
                        <div class="p-4">
                            <h2 class="text-base font-bold">{{ __('content.booking.Price_Summary') }}</h2>
                            <div class="flex justify-between text-left mt-3">
                                <p class="text-sm">{{ __('content.booking.room_price') }}</p>
                                <p class="text-sm">VND {{ number_format($price['roomPrices'], 0, ',', '.') }}
                                </p>
                            </div>
                            @if (auth()->user())
                                <div class="flex justify-between text-left my-2">
                                    <p class="text-sm">{{ __('content.booking.Membership_discount') }}</p>
                                    <p class="text-sm">- VND
                                        {{ number_format($price['membershipDiscounts'], 0, ',', '.') }}
                                    </p>
                                </div>
                            @endif
                            <div class="flex justify-between text-left my-2" id="discount-section" style="display: none;">
                                <p class="text-sm">{{ __('content.booking.Promotion_discount') }}</p>
                                <p class="text-sm" id="discount-amount">- VND 0</p>
                            </div>
                        </div>

                        <div class="w-full border bg-sky-100 p-4">
                            <div class="flex items-end">
                                <div class="w-2/5 pr-2">
                                    <h1 class="text-3xl font-bold">{{ __('content.booking.price') }}</h1>
                                </div>
                                <div class="w-3/5">
                                    @if ($price['originalPrices'] != $price['totalPrice'])
                                        <p class="line-through text-red-500 text-base text-right">
                                            VND {{ number_format($price['originalPrices'], 0, ',', '.') }}
                                        </p>
                                    @endif
                                    <p class="text-2xl font-bold text-right" id="final-total-price">VND
                                        {{ number_format($price['totalPrice'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right mt-2">
                                <p class="text-base">+VND
                                    {{ number_format($price['taxCalculationForRooms'], 0, ',', '.') }}
                                    {{ __('content.booking.taxes_and_fees') }}
                                </p>
                            </div>
                        </div>

                        <div class="p-4">
                            <h2 class="text-base font-bold">{{ __('content.booking.Price_information') }}</h2>
                            <div class="flex mt-3">
                                <div class="w-1/5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6 ml-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                    </svg>
                                </div>
                                <div class="w-4/5">
                                    <p class="text-sm">
                                        {{ __('content.booking.included') }} VND
                                        {{ number_format($price['taxCalculationForRooms'], 0, ',', '.') }}
                                        {{ __('content.booking.taxes_and_fees') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="mt-4 border rounded-md space-y-2 p-4">
                        <h2 class="text-base font-bold">
                            {{ __('content.booking.Do_you_have_a_promo_code') }}
                        </h2>

                        <form id="promotion-form" action="{{ route('apply.promotion') }}" method="POST">
                            @csrf
                            <div class="mt-4 sp">
                                <label for="promotion_code"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">{{ __('content.booking.Enter_promo_code') }}</label>
                                <input type="text" id="promotion_code" name="promotion_code"
                                    class="border border-gray-300 text-gray-900 bg-white text-sm rounded-lg block w-full p-2.5 outline-none"
                                    placeholder="{{ __('content.booking.Enter_promo_code') }}..." />
                                <div id="error-message" class="hidden text-red-500 text-base mt-1"></div>

                                <div>
                                    <button type="submit"
                                        class="mt-4 py-2.5 px-5 me-2 mb-2 text-sm font-medium text-blue-500 focus:outline-none bg-white rounded-md border border-blue-300 hover:bg-blue-100 hover:text-blue-500 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-white dark:text-blue-400 dark:hover:text-white dark:hover:bg-gray-700">
                                        {{ __('content.booking.Apply') }}
                                    </button>

                                    <!-- Nút để mở Modal -->
                                    <div>
                                        <button class="text-blue-600 hover:underline" onclick="openModal()">Lựa chọn mã
                                            giảm giá</button>
                                    </div>

                                    <!-- Modal -->
                                    <div id="promo-modal"
                                        class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                                        <div class="bg-blue-50 rounded-lg p-4 w-3/4 max-w-6xl">
                                            <div class="mt-4 flex justify-end">
                                                <button onclick="closeModal()"
                                                    class="px-4 py-2 rounded-lg text-red-600"><i class="ri-close-circle-line text-2xl text-red-500"></i></button>
                                            </div>
                                            <h2 class="text-3xl font-semibold text-center mb-4">
                                                {{ __('content.booking.choice_promo_code') }}</h2>
                                            <div
                                                class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-96 overflow-y-scroll hide-scroll">
                                                <!-- Mã giảm giá 1 -->
                                                @if ($list_promotion->isEmpty())
                                                    <div class="text-center text-gray-500 mt-4">
                                                        {{ __('content.booking.no_promotion_available') }}
                                                    </div>
                                                @else
                                                    @foreach ($list_promotion as $promotion)
                                                        <div class="mx-auto w-96 overflow-hidden">
                                                            <div
                                                                class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white text-center py-2 px-2 rounded-lg shadow-md relative">
                                                                <span class="w-12 mx-auto mb-2 rounded-lg">DreamNest</span>
                                                                <h3 class="text-base font-semibold mb-2 text-yellow-300">
                                                                    <p class="text-xs mb-2">
                                                                        {{ $promotion->long_description }}</p>
                                                                </h3>
                                                                <div
                                                                    class="flex items-center justify-center space-x-2 mb-2">
                                                                    <span id="cpnCode"
                                                                        class="border-dashed border text-white px-3 py-1 rounded-l">{{ $promotion->code }}</span>
                                                                    <button id="cpnBtn"
                                                                        class="border border-white bg-white text-purple-600 px-3 py-1 rounded-r cursor-pointer apply-promotion"
                                                                        data-code="{{ $promotion->code }}">
                                                                        {{ __('content.booking.use_promotion') }}
                                                                    </button>
                                                                </div>
                                                                <p class="text-xs mb-2">
                                                                    {{ __('content.booking.end_date') }}:
                                                                    {{ date('d-m-Y', strtotime($promotion->end_date)) }}
                                                                </p>
                                                                <div
                                                                    class="w-8 h-4 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 left-0 -ml-4">
                                                                </div>
                                                                <div
                                                                    class="w-8 h-4 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 right-0 -mr-4">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </aside>
            <main class="col-span-8 p-4 pt-6 px-3 space-y-6">
                <div class="border rounded-md p-4 mb-4">
                    <h2 class="text-xl font-bold mb-4">
                        {{ __('content.booking.Pay_now_with') }}
                    </h2>
                    <div class="pb-2">
                        <span class="text-base">{{ __('content.booking.You_will_complete_this_reservation') }}</span>
                    </div>
                </div>
                <section class="border rounded-md p-4 space-y-3">
                    <h2 class="text-xl font-bold">
                        {{ __('content.booking.How_would_you_like_to_pay') }}?
                    </h2>
                    <div class="pt-3">
                        <div class="px-3 py-4 mt-4 border-black rounded-md bg-gray-100 flex items-center">
                            <div>
                                <ion-icon name="lock-closed-outline" class="size-5 mt-1"></ion-icon>
                            </div>
                            <div class="ml-2">
                                <p class="text-sm">
                                    {{ __('content.booking.Payment_information_is_secure') }}
                                </p>
                            </div>
                        </div>
                        {{-- <form action="{{ route('vnpay.payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_price" value="{{ $price['totalPrice'] }}">
                            <input type="hidden" name="last_name" value="{{ $request['last_name'] }}">
                            <input type="hidden" name="first_name" value="{{ $request['first_name'] }}">
                            <input type="hidden" name="email" value="{{ $request['email'] }}">
                            <input type="hidden" name="phone_number" value="{{ $request['phone_number'] }}">
                            <input type="hidden" name="full_name_guest" value="{{ $request['full_name_guest'] }}">
                            <input type="hidden" name="email_guest" value="{{ $request['email_guest'] }}">
                            <input type="hidden" name="take_note" value="{{ $request['take_note'] }}">
                            <input type="hidden" name="time_check_in" value="{{ $request['time_check_in'] }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                            <input type="hidden" name="promotion_code" value="{{ session('promotion_code') }}">
                            <button type="submit" name="redirect"
                                class="mt-2 min-w-[600px] min-h-[55px] flex justify-center items-center bg-white border border-[#ccc] rounded-md shadow-2xl hover:bg-gray-200">
                                <div class="w-[150px] h-[25px]">
                                    <img src="https://res.cloudinary.com/drufel5fi/image/upload/v1732292640/vnpay-removebg-preview_ax3tek.png"
                                        class="object-cover w-full h-full" alt="" />
                                </div>
                            </button>
                        </form> --}}
                        <div class="space-y-6 pt-4">
                            <div id="paypal-button-container"></div>
                        </div>
                        <form id="booking-form" action="{{ route('save.booking') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_price" value="{{ $price['totalPrice'] }}">
                            <input type="hidden" name="last_name" value="{{ $request['last_name'] }}">
                            <input type="hidden" name="first_name" value="{{ $request['first_name'] }}">
                            <input type="hidden" name="email" value="{{ $request['email'] }}">
                            <input type="hidden" name="phone_number" value="{{ $request['phone_number'] }}">
                            <input type="hidden" name="full_name_guest" value="{{ $request['full_name_guest'] }}">
                            <input type="hidden" name="email_guest" value="{{ $request['email_guest'] }}">
                            <input type="hidden" name="take_note" value="{{ $request['take_note'] }}">
                            <input type="hidden" name="time_check_in" value="{{ $request['time_check_in'] }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">
                            <input type="hidden" name="promotion_code" value="{{ session('promotion_code') }}">
                            <input type="hidden" name="transaction_id" value="">
                            <input type="hidden" name="payer_email" value="">
                            <div class="flex flex-col gap-4">
                                <button type="submit" id="complete-booking-button"
                                    class="hidden min-w-[600px] min-h-[55px] flex justify-center items-center bg-[#ffc43a] rounded-md shadow-xl hover:bg-amber-500">
                                    <span class="text-white font-semibold text-xl">Hoàn tất đặt chỗ</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('booking.details') }}"
                        class="flex items-center justify-center px-7 py-2.5 me-2 mb-2 text-base font-medium text-blue-500 focus:outline-none bg-white rounded-md border border-blue-300 hover:bg-blue-100 hover:text-blue-500 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-blue-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        {{ __('content.booking.edit_information') }}
                    </a>
                </div>
            </main>
        </div>

    </div>
    @php
        $usdToVndRate = 24000;
        $totalPriceInVND = $price['totalPrice'];
        $totalPriceInUSD = round($totalPriceInVND / $usdToVndRate, 2);
    @endphp
    @include('client.layouts.footer')
@endsection
@push('scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AdQ9fsLBMUREgvpVOOcb13Zp6XcLUxLUA4bpF4lbyacAHEL0w-T_yATBLEC-539mE0Qy8ThTneSevmzd&currency=USD">
    </script>
    <script>
        function toggleDropdownInfo() {
            const dropdownInfo = document.getElementById("dropdownInfo");
            const arrowIcon = document.getElementById("arrow-icon");
            dropdownInfo.classList.toggle("hidden");
            arrowIcon.classList.toggle("rotate-180");
        }
    </script>
    <script>
        // Các hàm toàn cục
        function applyDiscountAndUpdateForm(newTotal) {
            document.querySelector('input[name="total_price"]').value = newTotal;
            updatePaymentButtonVisibility(newTotal);
        }

        function updateUIAfterDiscount(response) {
            $('#final-total-price').text(`VND ${new Intl.NumberFormat().format(response.new_total)}`);
            $('#discount-amount').text(`- VND ${new Intl.NumberFormat().format(response.discount_amount)}`).show();
            $('#discount-section').show();

            const usdToVndRate = 24000;
            const totalPriceInUSD = (response.new_total / usdToVndRate).toFixed(2);
            $('#final-total-price-usd').text(`USD ${totalPriceInUSD}`);
            updatePayPalButton(totalPriceInUSD);

            $('#error-message').removeClass('text-red-500').addClass('text-green-600').text(
                "Mã giảm giá áp dụng thành công!").show();
        }

        function updatePayPalButton(totalPriceInUSD) {
            $('#paypal-button-container').empty();
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: totalPriceInUSD
                            },
                            shipping: {
                                address: null
                            }
                        }],
                        application_context: {
                            shipping_preference: "NO_SHIPPING"
                        }
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        document.querySelector('input[name="transaction_id"]').value = details.id;
                        document.querySelector('input[name="payer_email"]').value = details.payer
                            .email_address;
                        document.getElementById('booking-form').submit();
                    });
                }
            }).render('#paypal-button-container');
        }

        function updatePaymentButtonVisibility(newTotal) {
            const paypalButtonContainer = document.getElementById('paypal-button-container');
            const completeBookingButton = document.getElementById('complete-booking-button');

            if (newTotal <= 0) {
                paypalButtonContainer.classList.add('hidden');
                completeBookingButton.classList.remove('hidden');
            } else {
                paypalButtonContainer.classList.remove('hidden');
                completeBookingButton.classList.add('hidden');
            }
        }

        function handleAjaxErrors(xhr) {
            $('#error-message').removeClass('text-green-600 hidden').addClass('text-red-500').show();

            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessages = '';
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages += `<div class="text-red-500 text-xs mt-1">${errors[key][0]}</div>`;
                        }
                    }
                    $('#error-message').html(errorMessages);
                } else {
                    $('#error-message').text(xhr.responseJSON.message);
                }
            } else {
                $('#error-message').text("Có lỗi xảy ra khi áp dụng mã giảm giá. Vui lòng thử lại.");
            }
        }

        // Khi trang vừa tải
        $(document).ready(function() {
            const initialTotalPrice = parseFloat($('input[name="total_price"]').val() || 0);

            updatePaymentButtonVisibility(initialTotalPrice);

            if (initialTotalPrice > 0) {
                const usdToVndRate = 24000;
                const initialTotalInUSD = (initialTotalPrice / usdToVndRate).toFixed(2);
                updatePayPalButton(initialTotalInUSD);
            }
        });

        // Xử lý form mã giảm giá
        $('#promotion-form').on('submit', function(e) {
            e.preventDefault();

            $('#error-message').empty().removeClass('text-red-500 text-green-600').addClass('hidden');
            $('.text-red-500.text-xs.mt-1').remove();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        applyDiscountAndUpdateForm(response.new_total);
                        updateUIAfterDiscount(response);
                    } else {
                        $('#error-message').removeClass('hidden').addClass('text-red-500').text(response
                            .message).show();
                        $('#discount-section').hide();
                    }
                },
                error: function(xhr) {
                    handleAjaxErrors(xhr);
                }
            });
        });


        function closeModal() {
            const modal = document.getElementById("promo-modal");
            modal.classList.add("hidden");
            document.body.style.overflow = "auto";
        }
        // Hàm hiển thị modal (nếu cần)
        function openModal() {
            const modal = document.getElementById("promo-modal");
            modal.classList.remove("hidden");
            document.body.style.overflow = "hidden";
        }

        // Hàm áp dụng mã giảm giá từ modal vào form chính
        $(document).on('click', '.apply-promotion', function() {
            // Lấy mã giảm giá từ nút đã nhấn
            const promoCode = $(this).data('code');

            // Điền mã giảm giá vào input trong form chính
            $('#promotion_code').val(promoCode);

            // Đóng modal
            closeModal();
        });
    </script>
@endpush
