@extends('client.layouts.master-layout')
@section('content')
    @include('client.layouts.header')
    <div>
        <!-- main -->
        <div class="max-w-screen-lg mx-auto">
            <div class="px-3 pt-6 mb-4 max-w-6xl">
                <div class="flex justify-between items-center space-x-4">
                    <!-- Step 1 -->
                    <div class="flex items-center">
                        <div class="flex items-center size-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 rounded-full bg-sky-600 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </div>
                        <p class="ml-2 font-bold text-sm">{{ __('content.booking.you_choose') }}</p>
                    </div>
                    <!-- Line Separator -->
                    <div class="border-t-2 border-black flex-grow"></div>
                    <!-- Step 2 -->
                    <div class="flex items-center">
                        <div class="flex items-center size-6">
                            <div class="flex items-center justify-center size-6 rounded-full bg-sky-600 text-white">
                                2
                            </div>
                        </div>
                        <p class="ml-2 font-bold text-sm">{{ __('content.booking.details_about_you') }}</p>
                    </div>
                    <!-- Line Separator -->
                    <div class="border-t-2 border-black flex-grow"></div>
                    <!-- Step 3 -->
                    <div class="flex items-center">
                        <div class="flex items-center size-6">
                            <div
                                class="flex items-center justify-center size-6 rounded-full border-2 border-gray-600 text-gray-400">
                                3
                            </div>
                        </div>
                        <p class="ml-2 font-bold text-sm">{{ __('content.booking.final_step') }}</p>
                    </div>
                </div>
            </div>
            <div class="lg:container mx-auto grid grid-cols-12 max-w-6xl">
                <aside class="col-span-4 p-4 pt-6 px-3">
                    <div>
                        <div class="border rounded-md p-4">
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        <p class="text-xs mr-2">{{ __('content.booking.hotel') }}</p>
                                    </div>

                                </div>
                                <h1 class="text-base font-bold">{{ $rooms[0]['destinations']->name }}</h1>
                            </div>
                            <div class="mt-1 space-y-3">
                                <div>
                                    <p class="text-sm">
                                        {{ $rooms[0]['destinations']->detailed_address }} {{ $location_address }}
                                    </p>
                                </div>
                                <div class="flex flex-row items-center my-2">
                                    <div class="mr-2">
                                        <span
                                            class="inline-block rounded-md text-xs w-6 h-6 items-center justify-center border-2 border-blue-700 bg-blue-700 basis-1/4">
                                            <p class="text-center text-sm font-normal text-white">
                                                {{ $review['averageRating'] }}
                                            </p>
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <p class="text-xs">
                                            @if ($review['averageRating'] >= 4.5)
                                                {{ __('content.booking.Excellence') }}
                                            @elseif($review['averageRating'] >= 4)
                                                {{ __('content.booking.Good') }}
                                            @elseif($review['averageRating'] >= 3.5)
                                                {{ __('content.booking.pretty_good') }}
                                            @elseif($review['averageRating'] >= 3)
                                                {{ __('content.booking.medium') }}
                                            @else
                                                {{ __('content.booking.below_average') }}
                                            @endif
                                        </p>
                                        <span class="text-xs mx-1">.</span>
                                        <!-- Dấu chấm -->
                                        <p class="text-xs">{{ $review['totalReviews'] }}
                                            {{ __('content.booking.Evaluate') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border rounded-md p-4 mt-4">
                            <div class="space-y-5">
                                <h2 class="text-base font-bold">{{ __('content.booking.your_booking_details') }}</h2>
                                <div>
                                    <div>
                                        <div class="flex flex-row mt-4 justify-between">
                                            <div class="flex-1 pr-4 border-r-2">
                                                <div class="mb-1">
                                                    <p class="text-sm font-medium">{{ __('content.booking.check_in') }}</p>
                                                </div>
                                                <label class="text-base font-bold">
                                                    {{ $dateBooking['available_from'] }}
                                                </label><br />
                                                <span class="text-sm font-light">{{ __('content.booking.form') }}
                                                    14:00</span>
                                            </div>
                                            <div class="flex-1 pl-4">
                                                <div class="mb-1">
                                                    <p class="text-sm font-medium">{{ __('content.booking.check_out') }}
                                                    </p>
                                                </div>
                                                <label
                                                    class="text-base font-bold">{{ $dateBooking['available_to'] }}</label><br />
                                                <span class="text-sm font-light">{{ __('content.booking.to') }}
                                                    12:00</span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div>
                                                <p class="text-sm">{{ __('content.booking.total_length_of_stay') }}:</p>
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
                                </div>
                            </div>
                            <div>
                                <p class="text-gray-700 mt-2">{{ __('content.booking.you_have_selected') }}</p>
                                @php
                                    // Tính tổng số lượng phòng
                                    $totalQuantity = array_sum(array_column($rooms, 'quantity'));
                                @endphp
                                <button onclick="yourChoiceDetail()" class="flex items-center w-full">
                                    <span class="flex-1 text-left rtl:text-right whitespace-nowrap font-bold text-black">
                                        {{ $totalQuantity }}x {{ __('content.booking.room_for') }}
                                        {{ $rooms[0]['room']->guest_quantity }} {{ __('content.booking.adult') }}
                                    </span>
                                    <svg id="arrow-icon" class="w-3 h-3 ml-2 transition-transform duration-300"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                <ul id="dropdownYourChoiceDetail"
                                    class="hidden space-y-0.5 transition-all duration-500 ease-in-out transform origin-top">
                                    @foreach ($rooms as $room)
                                        @if ($room['quantity'] > 0)
                                            <li class="mt-2">
                                                <div
                                                    class="w-full p-2 text-gray-900 bg-gray-100 transition duration-75 rounded-lg pl-4 group">
                                                    <div>
                                                        <span class="block text-black">{{ $room['quantity'] }}x
                                                            {{ $room['room']->name }}</span>
                                                        <span class="block text-xs mt-1 text-black">
                                                            {{ $room['room']->guest_quantity }}
                                                            {{ __('content.booking.adult') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <div class="mt-2">
                                    <a href="{{ route('hotel-details', ['id' => $rooms[0]['destinations']->id]) }}"
                                        class="text-sm fornt-semibold text-blue-500">{{ __('content.booking.Change_your_choice') }}</a>
                                </div>
                            </div>

                        </div>

                        <section class="mt-4 border rounded-md space-y-5">
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
                            </div>
                            <div class="w-full border bg-sky-100 p-4">
                                <div class="flex items-end">
                                    <div class="w-2/5 pr-2">
                                        <h1 class="text-3xl font-bold">{{ __('content.booking.price') }}</h1>
                                    </div>
                                    <div class="w-3/5">
                                        @if (auth()->user())
                                            <p class="line-through text-red-500 text-base text-right">
                                                VND {{ number_format($price['originalPrices'], 0, ',', '.') }}
                                            </p>
                                        @endif
                                        <p class="text-2xl font-bold text-right">VND
                                            {{ number_format($price['totalPrice'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right mt-2">
                                    <p class="text-xs">+VND
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
                    </div>
                </aside>
                <main class="col-span-8 p-4 pt-6 px-3 space-y-3">
                    <form id="form-booking" action="{{ route('booking.payment') }}" method="POST">
                        @csrf
                        <div class="border rounded-md px-4 mb-4 flex items-center">
                            @if (auth()->user())
                                <div class="px-3 py-2 flex" id="profile">
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt=""
                                        class="border-2 border-yellow-500 rounded-full w-11 h-11" />
                                </div>

                                <div class="px-3 py-2">
                                    <p class="text-sm font-bold">{{ __('content.booking.you_are_logged_in') }}</p>
                                    <p class="text-sm">{{ auth()->user()->email }}</p>
                                </div>
                            @else
                                <div class="mx-auto p-4 rounded-lg">
                                    <p class="mb-2 text-sm">
                                        {{ __('content.booking.Save_10_or_more_on_this_option') }}
                                    </p>
                                    <div class="flex space-x-4 text-sm">
                                        <a href="{{ route('login') }}"
                                            class="text-blue-600 hover:underline">{{ __('content.booking.login') }}</a>
                                        <a href="{{ route('register') }}"
                                            class="text-blue-600 hover:underline">{{ __('content.booking.register') }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <section class="border rounded-md p-4 space-y-6">
                            <h2 class="text-xl font-bold">{{ __('content.booking.enter_your_details') }}</h2>
                            <div class="p-4 mb-4 border-black rounded-md bg-gray-300 flex items-start">
                                <div>
                                    <ion-icon name="alert-circle-outline" class="size-5 mt-1"></ion-icon>
                                </div>
                                <div class="ml-2">
                                    <p class="text-base mb-1">
                                        {{ __('content.booking.almost_done_Just_fill_in_the_required_information_*') }}
                                    </p>
                                    <p class="text-base">
                                        {{ __('content.booking.please_enter_details_in_Vietnamese_without_accents_so_the_hotel_can_read_it*') }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6">
                                    <label for="last_name"
                                        class="block text-sm font-medium text-gray-700">{{ __('content.booking.last_name') }}
                                        ({{ __('content.booking.english') }})*</label>
                                    <input type="text" name="last_name" id="last_name"
                                        class="mt-1 p-2 block w-full shadow-sm sm:text-sm border rounded-md"
                                        value="{{ auth()->user()->last_name ?? '' }}" />
                                </div>
                                @error('last_name')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-span-6">
                                    <label for="first_name"
                                        class="block text-sm font-medium text-gray-700">{{ __('content.booking.first_name') }}
                                        ({{ __('content.booking.english') }})*</label>
                                    <input type="text" name="first_name" id="first_name"
                                        class="mt-1 p-2 block w-full shadow-sm sm:text-sm border rounded-md"
                                        value="{{ auth()->user()->first_name ?? '' }}" />
                                </div>
                                @error('first_name')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-span-6">
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700">{{ __('content.booking.email') }}*</label>
                                    <input type="text" id="email" name="email"
                                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                        placeholder="name@gmail.com" value="{{ auth()->user()->email ?? '' }}" />
                                    <p class="text-xs">
                                        {{ __('content.booking.a_confirmation_email_will_be_sent_to_this_address') }}
                                    </p>
                                </div>
                                @error('email')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-span-6 ">
                                    <label for="phone_number"
                                        class="block text-sm font-medium text-gray-700">{{ __('content.booking.phone_number') }}*</label>
                                    <input type="tel" id="phone_number" name="phone_number"
                                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                        placeholder="{{ __('content.booking.enter_phone_number') }} ({{ __('content.booking.vd') }}: 1234567890)"
                                        inputmode="numeric"
                                        value="{{ preg_replace('/\D/', '', auth()->user()->phone_number ?? '') }}" />

                                </div>
                                @error('phone_number')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror

                            </div>
                        </section>
                        <section class="mt-4 p-4 border rounded-md">
                            @foreach ($rooms as $room)
                                @if ($room['quantity'] > 0)
                                    <div class="space-y-3">
                                        <h1 class="font-bold text-2xl capitalize">
                                            {{ $room['room']->name }}
                                        </h1>
                                        <div class="space-y-2">
                                            <div class="flex">
                                                <ion-icon name="checkmark-outline"
                                                    class="size-6 text-green-500"></ion-icon>
                                                <p class="text-green-700">
                                                    <strong>{{ __('content.booking.Flexible_date_change') }}</strong>
                                                    {{ __('content.booking.when_plans_change') }}
                                                </p>
                                            </div>
                                            <div class="flex">
                                                <ion-icon name="checkmark-outline"
                                                    class="size-6 text-green-500"></ion-icon>
                                                <p class="text-green-700">
                                                    <strong>{{ __('content.booking.Free_cancellation') }}</strong>
                                                    {{ __('content.booking.any_time') }}
                                            </div>
                                            <div class="flex">
                                                <ion-icon name="people-outline" class="size-6 mr-1"></ion-icon>
                                                <p><strong>{{ __('content.booking.guest') }}: </strong>
                                                    {{ $room['room']->guest_quantity }} {{ __('content.booking.adult') }}
                                                </p>
                                            </div>
                                            <div class="flex flex-wrap">
                                                @foreach ($convenients as $amenity)
                                                    <div class="amenity-item flex items-center mr-4">
                                                        @if ($amenity->icon_class)
                                                            <i
                                                                class="fas {{ $amenity->icon_class }} text-green-600 text-sm mr-2"></i>
                                                        @endif
                                                        <span>{{ $amenity->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 mt-3">
                                        <div class="col-span-12 px-2 pt-4 border-t-2"></div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="grid grid-cols-12 mt-3">

                                <div class="col-span-6 px-2 pt-4">
                                    <label for="full_name_guest"
                                        class="block text-sm font-medium text-gray-700">{{ __('content.booking.Full_Name_of_the_Guest') }}</label>
                                    <input type="text" name="full_name_guest" id="full_name_guest"
                                        class="mt-1 p-2 block w-full shadow-sm sm:text-sm border rounded-md"
                                        placeholder="{{ __('content.booking.first_name') }}, {{ __('content.booking.last_name') }}"
                                        value="{{ old('full_name_guest') }}" />
                                </div>
                                @error('full_name_guest')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror

                                <div class="col-span-6 px-2 pt-4">
                                    <label for="email_guest"
                                        class="block text-sm text-gray-700"><strong>{{ __('content.booking.email_of_the_Guest') }}</strong>
                                        ({{ __('content.booking.not_required') }})</label>
                                    <input type="text" id="email_guest" name="email_guest"
                                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                        placeholder="email@gmail.com" value="{{ old('email_guest') }}" />
                                    <div>
                                        <p class="text-xs">
                                            {{ __('content.booking.Email_is_only_used_to_send_booking_information') }} –
                                            <strong>{{ __('content.booking.ensure') }}.</strong>
                                        </p>
                                    </div>
                                </div>
                                @error('email_guest')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror

                            </div>
                        </section>
                        <div class="mt-4 p-4 border rounded-md">
                            <div class="space-y-4">
                                <h1 class="font-bold text-2xl capitalize">
                                    {{ __('content.booking.Special_Requests') }}
                                </h1>
                                <div class="space-y-4">
                                    <p>
                                        {{ __('content.booking.Special_requests_are_not') }}
                                    </p>
                                    <div>
                                        <label for="message"
                                            class="block mb-2 text-sm text-gray-900 dark:text-black"><strong>{{ __('content.booking.Please_write_your_request') }}.</strong>
                                            ({{ __('content.booking.not_required') }})</label>
                                        <textarea id="message" rows="4" name="take_note"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Write your thoughts here...">{{ old('take_note') }}</textarea>
                                    </div>
                                </div>
                                @error('take_note')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4 p-4 border rounded-md">
                            <div class="space-y-4">
                                <h1 class="font-bold text-2xl capitalize">
                                    {{ __('content.booking.Your_arrival_time') }}
                                </h1>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-8 text-green-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <p>{{ __('content.booking.Your_room_will_be_ready') }}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-6 space-y-2">
                                            <label for="countries"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-900">{{ __('content.booking.Select_a_time_period') }}</label>
                                            <select id="countries" name="time_check_in"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option >{{ __('content.booking.Select_a_time_period') }}</option>
                                                <option value="Tôi chưa chắc chắn" selected>
                                                    Tôi chưa chắc chắn
                                                </option>
                                                @for ($hour = 0; $hour < 24; $hour++)
                                                    @php
                                                        $start = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
                                                        $end = str_pad(($hour + 1) % 24, 2, '0', STR_PAD_LEFT) . ':00';
                                                    @endphp
                                                    <option value="{{ $start }} - {{ $end }}">
                                                        {{ $start }} - {{ $end }}</option>
                                                @endfor
                                            </select>
                                            @error('time_check_in')
                                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                            @enderror
                                            <p class="text-xs">
                                                {{ __('content.booking.Time_according_to_Vietnam_time_zone') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-base px-7 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                {{ __('content.booking.Next_Final_Details') }}
                            </button>
                        </div>
                    </form>
                </main>
            </div>
        </div>
    </div>
    <form id="redirect-to-payment" action="{{ route('booking.payment') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="last_name">
        <input type="hidden" name="first_name">
        <input type="hidden" name="email">
        <input type="hidden" name="phone_number">
        <input type="hidden" name="full_name_guest">
        <input type="hidden" name="email_guest">
        <input type="hidden" name="take_note">
        <input type="hidden" name="time_check_in">
    </form>
    @include('client.layouts.footer')
@endsection

@push('scripts')
    <script>
        function yourChoiceDetail() {
            const dropdownYourChoiceDetail = document.getElementById("dropdownYourChoiceDetail");
            const arrowIcon = document.getElementById("arrow-icon");
            dropdownYourChoiceDetail.classList.toggle("hidden");
            arrowIcon.classList.toggle("rotate-180");
        }
    </script>
    <script>
        // Validate
        $('#form-booking').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#redirect-to-payment input[name="last_name"]').val(formData.get('last_name'));
                    $('#redirect-to-payment input[name="first_name"]').val(formData.get('first_name'));
                    $('#redirect-to-payment input[name="email"]').val(formData.get('email'));
                    $('#redirect-to-payment input[name="phone_number"]').val(formData.get(
                        'phone_number'));
                    $('#redirect-to-payment input[name="full_name_guest"]').val(formData.get(
                        'full_name_guest'));
                    $('#redirect-to-payment input[name="email_guest"]').val(formData.get(
                        'email_guest'));
                    $('#redirect-to-payment input[name="take_note"]').val(formData.get('take_note'));
                    $('#redirect-to-payment input[name="time_check_in"]').val(formData.get(
                        'time_check_in'));
                    // Xóa lỗi và chuyển hướng khi thành công
                    $('#redirect-to-payment').submit();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;

                        // Xóa lỗi cũ
                        $('.text-red-500').remove();

                        // Hiển thị lỗi mới
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let input = $(`[name="${key}"]`);
                                let errorElement = input.next('.text-red-500');
                                if (errorElement.length) {
                                    errorElement.text(errors[key][0]); // Cập nhật lỗi
                                } else {
                                    // Thêm mới nếu chưa có
                                    input.after(
                                        `<div class="text-red-500 text-xs mt-1">${errors[key][0]}</div>`
                                    );
                                }
                            }
                        }
                    }
                },
            });
        });
    </script>
@endpush
