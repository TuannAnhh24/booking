@extends('client.layouts.master-layout')
@section('content')
    <!-- Icon Mess -->
    @if (Auth::id() !== $destination->users->first()->id)
        <div class="fixed right-5" style="bottom: 90px;">
            <a href="{{ route('user', ['id' => $destination->users->first()->id]) }}"
                class="w-16 h-16 p-2 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-xl hover:shadow-2xl transform transition-all duration-200 hover:bg-blue-600 hover:scale-110 relative group">
                <i class="ri-message-2-line text-3xl"></i>
                <span
                    class="absolute bottom-full mb-2 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 text-sm text-black transition-all duration-200 px-2 py-1 bg-white rounded-md shadow-lg tooltip">message</span>
            </a>
        </div>
    @endif
    @include('client.layouts.header')
    <div class="container-wraper mx-auto my-14 space-y-3">
        <div class="max-w-[1100px] mx-auto">
            <!-- navbar 1 -->
            <nav>
                <ol class="flex space-x-2">
                    @foreach ($breadcrumbs as $index => $breadcrumb)
                        <li class="flex items-center">
                            @if ($breadcrumb['url'] !== '#')
                                <a href="{{ $breadcrumb['url'] }}"
                                    class="text-blue-500 text-base">{{ $breadcrumb['label'] }}</a>
                            @else
                                <span class="text-gray-500 text-base">{{ $breadcrumb['label'] }}</span>
                            @endif
                            @if ($index < count($breadcrumbs) - 1)
                                <i class="fa-solid fa-chevron-right text-[8px] px-3"></i>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
            <!-- navbar 2 -->
            <nav class="pt-4 border-b scroll-smooth">
                <ul class="flex justify-between">
                    <li class="w-full hover:bg-gray-200 ">
                        <a href="#" class="text-center block py-4 active">
                            <span class="inline-block text-sm">{{ __('content.hotel_detail.overview') }}</span>
                        </a>
                    </li>
                    <li class="w-full hover:bg-gray-200">
                        <a href="#date-selection-form" class="text-center block py-4">
                            <span class="inline-block text-sm">{{ __('content.hotel_detail.price_info') }}</span>
                        </a>
                    </li>
                    <li class="w-full hover:bg-gray-200">
                        <a href="#target-2" class="text-center block py-4">
                            <span class="inline-block text-sm">{{ __('content.hotel_detail.amenities') }}</span>
                        </a>
                    </li>
                    <li class="w-full hover:bg-gray-200">
                        <a href="#general-rules" class="text-center block py-4">
                            <span class="inline-block text-sm">{{ __('content.hotel_detail.general_rules') }}</span>
                        </a>
                    </li>
                    <li class="w-full hover:bg-gray-200">
                        <a href="#reviews" class="text-center block py-4 aboutMeLink">
                            <span class="inline-block text-sm">{{ $reviewCount }}
                                {{ __('content.hotel_detail.reviews') }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="max-w-[1100px] mx-auto">
            <!-- title product -->
            <div class="grid grid-cols-10 gap-4 mt-4">
                <div class="col-span-7 grid grid-rows-2 gap-2">
                    <div class="flex items-center">
                        <h2 class="text-4xl font-bold mr-4">
                            {{ $destination->name }}
                        </h2>
                    </div>
                    <div class="flex items-center justify-start space-x-2 text-sm mb-5">
                        <i class="fas fa-map-marker-alt text-blue-500"></i>
                        <div class="flex">
                            <p class="mr-2">
                                {{ $destination->detailed_address }}
                                {{ isset($destination->locations[0]) ? ' - ' . $destination->locations[0]->pivot->address : '' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-span-3 grid grid-rows-2 gap-4">
                    <div class="flex items-center justify-end space-x-2">
                        <button type="submit" onclick="scrollToRooms(event)"
                            class="flex items-center justify-center bg-[#006ce3] text-white rounded-md px-4 py-2">
                            <span>{{ __('content.hotel_detail.book_your_apartment') }}</span>
                        </button>
                    </div>

                    <div class="flex items-center justify-end space-x-2">
                        <span><i class="fas fa-tag text-[#006ce3]"></i></span>
                        <span
                            class="text-[#006ce4] font-medium">{{ __('content.hotel_detail.we_always_match_prices') }}</span>
                    </div>
                </div>
            </div>
            <!-- images, comment, address -->
            <div class="grid lg:grid-cols-12 gap-4">
                <!-- images -->
                <div class="col-span-9">
                    <div class="grid gap-4">
                        <div class="flex flex-row gap-2">
                            @if ($destination->images->count() > 2)
                                <div class="w-full h-[410px] object-cover rounded-l-lg overflow-hidden cursor-pointer">
                                    <img class="h-full w-full object-cover rounded-sm openModal transition-transform duration-300 hover:scale-110"
                                        src="{{ asset('storage/' . $destination->images[2]->image) }}"
                                        alt="{{ $destination->images[2]->description ?? 'Room Image' }}" />
                                </div>
                            @endif
                            <div class="flex flex-col w-1/2">
                                <!-- Display the first two images if available -->
                                @if ($destination->images->count() > 0)
                                    <div class="w-full h-[200px] mb-2 overflow-hidden cursor-pointer">
                                        <img class="h-full w-full object-cover rounded-sm openModal transition-transform duration-300 hover:scale-110"
                                            src="{{ asset('storage/' . $destination->images[0]->image) }}"
                                            alt="{{ $destination->images[0]->description ?? 'destination Image' }}" />
                                    </div>
                                @endif
                                @if ($destination->images->count() > 1)
                                    <div class="w-full h-[200px] overflow-hidden cursor-pointer">
                                        <img class="h-full w-full object-cover rounded-sm openModal transition-transform duration-300 hover:scale-110"
                                            src="{{ asset('storage/' . $destination->images[1]->image) }}"
                                            alt="{{ $destination->images[1]->description ?? 'Room Image' }}" />
                                    </div>
                                @endif
                            </div>
                            <!-- Display the third image in the right column if available -->

                        </div>

                        <div class="grid grid-cols-5 gap-4">
                            @php
                                $totalImages = $destination->images->count();
                                $skippedImages = $destination->images->skip(3)->take(5);
                            @endphp

                            @foreach ($skippedImages as $image)
                                <div class="relative">
                                    <div class="h-full h-[150px] overflow-hidden cursor-pointer">
                                        <img class="h-full w-full object-cover rounded-sm openModal transition-transform duration-300 hover:scale-110"
                                            src="{{ asset('storage/' . $image->image) }}"
                                            alt="{{ $image->description ?? 'Room Image' }}" />
                                    </div>
                                    @if ($loop->last && $totalImages > 8)
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-sm overflow-hidden cursor-pointer transition-transform duration-300 hover:scale-110">
                                            <span class="text-white text-xl font-semibold">
                                                +{{ $totalImages - 8 }} ảnh
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-span-3">
                    <div class="flex flex-col h-full w-full">
                        <!-- rate -->
                        <div class="flex justify-end items-center p-3 border">
                            <div class="flex flex-col justify-between mr-2">
                                <div class="text-end text-base text-black leading-none">
                                    @if ($averageRating > 8)
                                        {{ __('content.hotel_detail.very_good') }}
                                    @elseif($averageRating > 6)
                                        {{ __('content.hotel_detail.good') }}
                                    @elseif($averageRating > 4)
                                        {{ __('content.hotel_detail.average') }}
                                    @else
                                        {{ __('content.hotel_detail.poor') }}
                                    @endif
                                </div>
                                <div class="text-end text-xs text-[#333] leading-none">
                                    {{ $reviewCount }} {{ __('content.hotel_detail.reviews') }}
                                </div>
                            </div>
                            <div
                                class="text-base text-white bg-[#003c95] py-[5.9px] px-[6.9px] rounded-tl rounded-tr rounded-br flex justify-center items-center">
                                <p>{{ number_format($averageRating, 1) }}</p>
                            </div>
                        </div>
                        <!-- comment -->
                        <div class="border p-3">
                            <div class="text-xs text-[#1a1a1a]">
                                {{ __('content.hotel_detail.what_guests_like') }}
                            </div>
                            <div class="mx-4">
                                @if ($destination->reviews->isNotEmpty())
                                    <p class="text-xs text-[#1a1a1a] py-3">
                                        “{{ $destination->reviews->first()->comment }}”
                                    </p>
                                    <div class="flex">
                                        <div class="flex items-center mr-2">
                                            <img src="{{ asset('storage/' . $destination->reviews->first()->user->avatar) }}"
                                                class="w-[24px] h-[24px] rounded-full mr-2" alt="User Avatar" />
                                            <span
                                                class="text-xs text-[#595959]">{{ $destination->reviews->first()->user->first_name }}</span>
                                        </div>

                                    </div>
                                @else
                                    <p class="text-xs text-[#1a1a1a] py-3">
                                        {{ __('content.hotel_detail.not_reviews_yet') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="py-2 px-1 relative">
                            <img src="https://cdn.buttercms.com/Ym1iRZNbRHOeWv0X4x3w" class="object-cover h-full w-full"
                                alt="" />
                            <button
                                onclick="openGoogleMaps('{{ $destination->detailed_address }} {{ isset($destination->locations[0]) ? '- ' . $destination->locations[0]->pivot->address : '' }}')"
                                class="absolute whitespace-nowrap left-[50%] top-[50%] text-base translate-y-[-50%] translate-x-[-50%] py-2 px-3 bg-[#006ce3] text-white rounded-md">
                                {{ __('content.hotel_detail.show_on_map') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid lg:grid-cols-12 gap-8 my-4">
                <div class="flex-initial col-span-8">
                    @guest
                        <p class="text-sm">
                            {{ __('content.hotel_detail.discount_message', ['hotel_name' => $destination->name]) }}
                            <a href="{{ route('login') }}">{{ __('content.hotel_detail.login') }}</a>
                        </p>
                    @endguest
                    <div class="whitespace-pre-line break-words">
                        {{ $destination->description }}
                    </div>
                    <div id="target-2">
                        <h2 class="text-lg font-bold mt-4">
                            {{ __('content.hotel_detail.popular_amenities') }}
                        </h2>
                        <ul class="flex flex-wrap">
                            @foreach ($destination->convenients as $convenient)
                                <li class="p-2">
                                    <div class="inline-flex items-center gap-2 p-2 rounded-lg">
                                        @if ($convenient->icon_class)
                                            <i class="fas {{ $convenient->icon_class }} text-green-600 text-sm mr-2"></i>
                                        @endif
                                        <span class="text-base text-green-800">{{ $convenient->name }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- banner login -->
            @guest
                <div class="flex justify-between border p-4">
                    <div class="flex flex-col justify-between">
                        <div class="mb-2">
                            <h1 class="text-xl font-bold">{{ __('content.hotel_detail.login_to_save') }}</h1>
                        </div>
                        <div class="mb-2">
                            <p class="text-xs">
                                {{ __('content.hotel_detail.save_opportunity') }}
                            </p>
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}"
                                class="btn border border-blue-500 py-2 px-4 text-sm rounded-full text-blue-500">
                                {{ __('content.hotel_detail.login') }}
                            </a>
                            <a href="{{ route('register') }}"
                                class="text-xs hover:underline hover:text-blue-500 text-blue-500">
                                {{ __('content.hotel_detail.create_account') }}
                            </a>
                        </div>
                    </div>

                    <div class="flex">
                        <img src="https://q-xx.bstatic.com/xdata/images/xphoto/248x248/294910959.jpeg?k=e459f57356fb64e8550e5b8c3d2352d50b49de3555b7bcea982678ef36e636ea&o="
                            alt="{{ __('content.hotel_detail.no_image') }}" height="104px" width="104px" />
                    </div>
                </div>
            @endguest


            <!-- filter Phòng trống-->
            <div class="space-y-6">
                <div>
                    <h2 class="font-bold text-3xl">Phòng trống</h2>
                </div>
                <form id="date-selection-form" action="{{ route('hotel-details', ['id' => $destination->id]) }}"
                    method="GET" class="mb-6">
                    <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                    <div class="flex items-center border-2 border-yellow-400 rounded w-[779px]">

                        <!-- Check-in Date -->



                        <div class="relative" for="check_in_date">
                            <input type="date" id="check_in_date" name="check_in_date" required
                                value="{{ old('check_in_date', $checkInDate) }}"
                                class="border-2 border-yellow-400 p-2 pl-10 pr-4 rounded w-full"
                                placeholder="{{ __('content.hotel_detail.check_in_date') }}">
                            <i
                                class="fas fa-calendar-day absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        </div>


                        <!-- Check-out Date -->


                        <div class="relative" for="check_out_date">
                            <input type="date" id="check_out_date" name="check_out_date" required
                                value="{{ old('check_out_date', $checkOutDate) }}"
                                class="border-2 border-yellow-400 p-2 pl-10 pr-4 rounded w-full"
                                placeholder="{{ __('content.hotel_detail.check_out_date') }}">
                            <i
                                class="fas fa-calendar-day absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        </div>



                        <!-- Guest Count -->


                        <div class="flex items-center border-2 border-yellow-400 rounded w-28" for="guest_count">
                            <button type="button"
                                class="px-2 py-1 rounded hover:bg-gray-100 hover:scale-105 transition duration-300 ml-2"
                                onclick="minusGuest()">-</button>
                            <input type="number" id="guest_count" name="guest_count" class="w-12 text-center border-0"
                                value="{{ old('guest_count', $guest_count) }}" readonly>
                            <button type="button"
                                class="px-2 py-1 rounded hover:bg-gray-100 hover:scale-105 transition duration-300"
                                onclick="plusGuest()">+</button>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 border-2 border-yellow-400 text-white px-6 py-2 font-bold rounded">
                                {{ __('content.hotel_detail.search_availability') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!--Table -->
            <div class="py-6" id="available-rooms">
                @include('client.hotel_details.available_rooms', [
                    'destination' => $destination,
                    'checkInDate' => $checkInDate,
                    'checkOutDate' => $checkOutDate,
                ])
            </div>
            <!-- đánh giá của khách -->
            <div>
                <div class="flex justify-between mt-4 my-4">
                    <div>
                        <h2 class="font-bold text-3xl">{{ __('content.hotel_detail.guest_reviews') }}</h2>
                    </div>
                    <div>
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline">
                            <span>{{ __('content.hotel_detail.check_availability') }}</span>
                        </button>
                    </div>
                </div>
                <button>
                    <div class="flex">
                        <div class="flex justify-center gap-3">
                            <div class="bg-blue-900 w-10 h-7 text-xl rounded-sm text-center">
                                <span class="text-white">{{ number_format($averageRating, 1) }}</span>
                            </div>
                            <div>
                                <span class="font-bold">{{ __('content.hotel_detail.excellent') }}</span>
                            </div>
                            <div>
                                <span class="font-bold" style="color: #58595e">
                                    {{ $reviewCount }} {{ __('content.hotel_detail.reviews') }}
                                </span>
                            </div>
                            <div>
                                <span class="text-blue-500">
                                    <a href="#" class="aboutMeLink hover:underline">
                                        {{ __('content.hotel_detail.read_all_reviews') }}
                                    </a>
                                </span>
                            </div>

                        </div>
                    </div>
                </button>

                <div class="py-5">
                    <div class="py-2">
                        <h3 class="text-xl font-bold mt-2 mb-2">{{ __('content.hotel_detail.categories') }}</h3>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <div class="text-sm">{{ __('content.hotel_detail.staff_service') }}</div>
                                </div>
                                <div class="mt-2">{{ number_format($reviews->avg('staff_rating'), 1) }}</div>
                            </div>
                            @php
                                $width = $reviews->avg('staff_rating') * 10;
                            @endphp

                            <div class="bg-gray-200 rounded-full h-[8px]">
                                <span class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                            </div>

                        </div>
                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <div class="text-sm">{{ __('content.hotel_detail.comfort') }}</div>
                                </div>
                                <div class="mt-2">{{ number_format($reviews->avg('comfort_rating'), 1) }}</div>
                            </div>
                            @php
                                $width = $reviews->avg('comfort_rating') * 10;
                            @endphp

                            <div class="bg-gray-200 rounded-full h-[8px]">
                                <span class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                            </div>

                        </div>

                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <div class="text-sm">{{ __('content.hotel_detail.cleanliness') }}</div>
                                </div>
                                <div class="mt-2">{{ number_format($reviews->avg('cleanliness_rating'), 1) }}</div>
                            </div>
                            @php
                                $width = $reviews->avg('cleanliness_rating') * 10;
                            @endphp

                            <div class="bg-gray-200 rounded-full h-[8px]">
                                <span class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                            </div>

                        </div>

                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <div class="text-sm">{{ __('content.hotel_detail.amenities') }}</div>
                                </div>
                                <div class="mt-2">{{ number_format($reviews->avg('amenities_rating'), 1) }}</div>
                            </div>
                            @php
                                $width = $reviews->avg('amenities_rating') * 10;
                            @endphp

                            <div class="bg-gray-200 rounded-full h-[8px]">
                                <span class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                            </div>

                        </div>

                        <div>
                            <div class="flex justify-between">
                                <div class="flex gap-1 text-sm">{{ __('content.hotel_detail.value_for_money') }}</div>
                                <div class="mt-2">{{ number_format($reviews->avg('value_for_money_rating'), 1) }}</div>
                            </div>
                            @php
                                $width = $reviews->avg('value_for_money_rating') * 10;
                            @endphp

                            <div class="bg-gray-200 rounded-full h-[8px]">
                                <span class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                            </div>

                        </div>

                        <div>
                            <div class="flex justify-between">
                                <div>
                                    <div class="text-sm">{{ __('content.hotel_detail.location') }}</div>
                                </div>
                                <div class="mt-2">{{ number_format($reviews->avg('location_rating'), 1) }}</div>
                            </div>
                            @php
                                $width = $reviews->avg('location_rating') * 10;
                            @endphp

                            <div class="bg-gray-200 rounded-full h-[8px]">
                                <span class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- comment: đánh giá -->
            <div>
                @if ($reviews->isEmpty())
                    <p class="text-center text-gray-500 mt-4">
                        {{ __('content.hotel_detail.no_reviews_available') }}
                    </p>
                @else
                    <div class="mt-8">
                        <h3 class="font-bold text-xl mb-6">{{ __('content.hotel_detail.customer_like_best') }}</h3>
                        <div class="relative container mx-auto max-w-6xl">
                            <div id="carousel" class="flex gap-2 overflow-hidden">
                                @foreach ($reviews as $review)
                                    <div class="carousel-item-cmt flex-shrink-0 p-2 w-[350px]">
                                        <div class="p-4 bg-white rounded-lg shadow-md h-full">
                                            <div class="flex items-center space-x-3 mb-3">`
                                                <img class="object-cover rounded-full h-10 w-10"
                                                    src="{{ asset('storage/' . $review->user->avatar) ?? asset('image/1.jpg') }}"
                                                    alt="User Avatar" />
                                                <div>
                                                    <p class="font-bold">{{ $review->user->first_name }}
                                                        {{ $review->user->last_name }}</p>
                                                    <div class="flex items-center space-x-2">
                                                        <p class="text-sm">{{ $review->user->nationality ?? 'Unknown' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-72 rounded-md text-sm resize-none h-24 outline-none border-none">
                                                {{ Str::limit($review->comment, 100) }} <!-- Giới hạn ở 100 ký tự -->
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                <button id="prev-button"
                                    class="absolute top-1/2 left-[-20px] transform -translate-y-1/2 bg-white shadow-md rounded-full w-10 h-10 text-black hover:bg-gray-100"
                                    disabled>
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <button id="next-button"
                                    class="absolute top-1/2 right-[-20px] transform -translate-y-1/2 bg-white shadow-md rounded-full w-10 h-10 text-black hover:bg-gray-100">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="py-5">
                            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                class=" bg-blue-500 rounded-lg px-4 py-2 block text-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-400 font-medium text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 aboutMeLink"
                                type="button">
                                <span class="  text-white">{{ __('content.hotel_detail.read_all_reviews') }}</span>
                            </button>
                        </div>
                    </div>
                @endif
                <!-- chính sách -->
                <div id="general-rules" class="py-10 space-y-3">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="font-bold text-3xl"><a href="#"
                                    id="aboutMeLink">{{ __('content.hotel_detail.policy') }}</a></h1>
                        </div>

                        <div>
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline w-">
                                <span>{{ __('content.hotel_detail.see_availability') }}</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl text-gray-600">
                            {{ $destination->name }} {{ __('content.hotel_detail.request_process') }}
                        </h2>
                    </div>

                    <div class="mx-auto p-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="space-y-4 w-full">
                                <!-- Hàng 1 -->
                                <div class="flex justify-between items-center border-b border-gray-300 pb-2 w-full">
                                    <div class="flex items-center text-xl gap-3">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        <h2>{{ __('content.hotel_detail.check_in') }}</h2>
                                    </div>
                                    <div class="flex flex-col w-1/2 h-full">
                                        <span>{{ __('content.hotel_detail.time_1') }}</span>
                                        <span>{{ __('content.hotel_detail.policy_1') }}</span>
                                    </div>
                                </div>

                                <!-- Hàng 2 -->
                                <div class="flex justify-between items-center border-b border-gray-300 pb-2 w-full">
                                    <div class="flex items-center text-xl gap-3">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        <span>{{ __('content.hotel_detail.check_out') }}</span>
                                    </div>
                                    <div class="flex flex-col w-1/2 h-full">
                                        <span>{{ __('content.hotel_detail.time_2') }}</span>
                                    </div>
                                </div>

                                <!-- Hàng 3 -->
                                <div class="flex justify-between items-center border-b border-gray-300 pb-2 w-full">
                                    <div class="flex items-center text-xl gap-3">
                                        <i class="fas fa-credit-card mr-2"></i>
                                        <span>{{ __('content.hotel_detail.cancellation_prepayment') }}</span>
                                    </div>
                                    <div class="flex flex-col r w-1/2 h-full">
                                        <span>{{ __('content.hotel_detail.policy_2') }}</span>
                                    </div>
                                </div>

                                <!-- Hàng 4 -->


                                <!-- Hàng 5 -->
                                <div class="flex justify-between items-center border-b border-gray-300 pb-2 w-full">
                                    <div class="flex items-center text-xl gap-3">
                                        <i class="fas fa-user-check mr-2"></i>
                                        <span>{{ __('content.hotel_detail.no_age_limit') }}</span>
                                    </div>
                                    <div class="flex flex-col w-1/2 h-full">
                                        <span>{{ __('content.hotel_detail.no_age_requirements_for_check_in') }}</span>
                                    </div>
                                </div>

                                <!-- Hàng 6 -->
                                <div class="flex justify-between items-center pb-2 w-full">
                                    <div class="flex items-center text-xl gap-3">
                                        <i class="fas fa-paw mr-2"></i>
                                        <span>{{ __('content.hotel_detail.pets') }}</span>
                                    </div>
                                    <div class="flex flex-col w-1/2 h-full">
                                        <span>{{ __('content.hotel_detail.pets_not_allowed') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('client.hotel_details.modal_comment')
        @include('client.hotel_details.write_review')
        @include('client.hotel_details.modal_typeRoom_Image')
        @include('client.hotel_details.modal_destination_image')
    </div>
    @include('client.layouts.footer')
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('css/client/Detail.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/client/date.js') }}"></script>
    <script>
        function minusGuest() {
            const guestInput = document.getElementById('guest_count');
            let currentValue = parseInt(guestInput.value);

            // Giảm số lượng khách nếu giá trị > 0
            if (currentValue > 0) {
                guestInput.value = currentValue - 1;
            }
        }

        function plusGuest() {
            const guestInput = document.getElementById('guest_count');
            let currentValue = parseInt(guestInput.value);

            // Tăng số lượng khách
            guestInput.value = currentValue + 1;
        }

        function toggleModal(show) {
            const modal = document.getElementById('reviewModal');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
        // Preview images when files are selected
        function previewImages(event) {
            const imageInput = event.target;
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const previewGrid = document.getElementById('previewGrid');

            previewGrid.innerHTML = ''; // Clear previous previews

            if (imageInput.files && imageInput.files.length > 0) {
                imagePreviewContainer.classList.remove('hidden');

                Array.from(imageInput.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-full', 'h-auto', 'rounded-md');
                        previewGrid.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                imagePreviewContainer.classList.add('hidden');
            }
        }

        // Open Google Maps with the provided address
        function openGoogleMaps(address) {
            if (address) {
                const url = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`;
                window.open(url, '_blank');
            } else {
                alert("Không có địa chỉ để hiển thị trên bản đồ.");
            }
        }

        // Modal functionality
        const aboutMeLinks = document.querySelectorAll('.aboutMeLink');
        const aboutMeModal = document.getElementById('aboutMeModal');
        const modalPanel = document.getElementById('modalPanel');
        const modalOverlay = aboutMeModal.querySelector('.bg-gray-500');
        const closeModalBtn = document.getElementById('closeModalBtn');

        function openModal() {
            aboutMeModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            setTimeout(() => {
                modalPanel.classList.remove('translate-x-full');
            }, 10);
        }

        function closeModal() {
            modalPanel.classList.add('translate-x-full');
            setTimeout(() => {
                aboutMeModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        aboutMeLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                openModal();
            });
        });

        closeModalBtn.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', closeModal);

        // Initialize date inputs with today and tomorrow's dates
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split('T')[0];
            let tomorrow = new Date();
            tomorrow.setDate(new Date().getDate() + 1);
            tomorrow = tomorrow.toISOString().split('T')[0];

            let checkInDateField = document.getElementById("check_in_date");
            let checkOutDateField = document.getElementById("check_out_date");

            if (!checkInDateField.value) {
                checkInDateField.value = today;
            }

            if (!checkOutDateField.value) {
                checkOutDateField.value = tomorrow;
            }
        });

        // Update booking summary based on room selection
        document.addEventListener('DOMContentLoaded', function() {
            const roomSelects = document.querySelectorAll('.room-select');
            const bookingButton = document.getElementById('booking_btn');
            const totalPriceElement = document.getElementById('total_price');

            function updateBookingSummary() {
                let totalPrice = 0;
                let totalRooms = 0;

                roomSelects.forEach(select => {
                    const roomQuantity = parseInt(select.value, 10);
                    const pricePerNight = parseFloat(select.getAttribute('data-price'));

                    if (roomQuantity > 0) {
                        totalRooms += roomQuantity;
                        totalPrice += roomQuantity * pricePerNight;
                    }
                    select.blur();
                });

                totalPriceElement.textContent = `VND ${totalPrice.toLocaleString('vi-VN')}`;
                bookingButton.disabled = totalRooms === 0;
            }

            roomSelects.forEach(select => {
                select.addEventListener('change', updateBookingSummary);
            });

            updateBookingSummary();
        });

        // Handle booking summary and price updates
        document.addEventListener('DOMContentLoaded', function() {
            const roomSelects = document.querySelectorAll('.room-select');
            const bookingSummary = document.getElementById('booking_summary');
            const originalPriceElement = document.getElementById('original_price');
            const discountedPriceElement = document.getElementById('discounted_price');
            const taxAndFee = document.getElementById('tax_and_fee');
            const bookingBtn = document.getElementById('booking_btn');
            const totalRoomsElement = document.getElementById('total_rooms');

            function updateBookingSummary() {
                let totalRooms = 0;
                let totalOriginalPrice = 0;
                let totalDiscountedPrice = 0;
                let taxAmount = 0;
                let finalTotalPrice = 0;

                roomSelects.forEach(select => {
                    const selectedOption = select.options[select.selectedIndex];
                    const quantity = parseInt(select.value);
                    const roomPrice = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                    const isAuthenticated = select.getAttribute('data-is-authenticated') === '1';

                    if (quantity > 0) {
                        totalRooms += quantity;
                        if (isAuthenticated) {
                            totalOriginalPrice += (roomPrice / 0.9);
                            totalDiscountedPrice += roomPrice;
                        } else {
                            totalOriginalPrice += roomPrice;
                            totalDiscountedPrice += roomPrice;
                        }
                    }
                });

                taxAmount = totalOriginalPrice * 0.08
                finalTotalPrice = totalDiscountedPrice + taxAmount;

                if (totalRooms > 0) {
                    bookingSummary.classList.remove('hidden');
                    discountedPriceElement.classList.remove('hidden');
                    taxAndFee.classList.remove('hidden');

                    totalRoomsElement.textContent = totalRooms;

                    if (totalOriginalPrice !== totalDiscountedPrice) {
                        originalPriceElement.classList.remove('hidden');
                        originalPriceElement.textContent = `VND ${formatPrice(totalOriginalPrice)}`;
                        discountedPriceElement.textContent = `VND ${formatPrice(totalDiscountedPrice)}`;
                    } else {
                        originalPriceElement.classList.add('hidden');
                        discountedPriceElement.textContent = `VND ${formatPrice(totalDiscountedPrice)}`;
                    }

                    taxAndFee.textContent = `Thuế (8%): VND ${formatPrice(taxAmount)}`;
                    discountedPriceElement.textContent =
                        `Tổng tiền (bao gồm thuế): VND ${formatPrice(finalTotalPrice)}`;

                    bookingBtn.disabled = false;
                } else {
                    bookingSummary.classList.add('hidden');
                    originalPriceElement.classList.add('hidden');
                    discountedPriceElement.classList.add('hidden');
                    taxAndFee.classList.add('hidden');
                    bookingBtn.disabled = true;
                }
            }

            function formatPrice(price) {
                return new Intl.NumberFormat('vi-VN').format(Math.round(price));
            }

            roomSelects.forEach(select => {
                select.addEventListener('change', updateBookingSummary);
            });

            updateBookingSummary();
        });


        // Handle URL parameters for check-in and check-out dates
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('check_in_date') || urlParams.has('check_out_date')) {
                const element = document.getElementById('available-rooms');
                if (element) {
                    element.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });

        // Set date restrictions
        document.addEventListener('DOMContentLoaded', function() {
            const checkInInput = document.getElementById('check_in_date');
            const checkOutInput = document.getElementById('check_out_date');
            const today = new Date().toISOString().split('T')[0];

            checkInInput.min = today;
            checkOutInput.min = today;

            checkInInput.addEventListener('change', function() {
                checkOutInput.min = this.value;
                if (checkOutInput.value && checkOutInput.value <= this.value) {
                    checkOutInput.value = '';
                }
            });

            checkOutInput.addEventListener('change', function() {
                checkInInput.max = this.value;
                if (checkInInput.value && checkInInput.value >= this.value) {
                    checkInInput.value = '';
                }
            });
        });

        // Store date selection in localStorage
        document.getElementById('date-selection-form').addEventListener('submit', function(event) {
            localStorage.setItem('check_in_date', document.getElementById('check_in_date').value);
            localStorage.setItem('check_out_date', document.getElementById('check_out_date').value);
        });

        // Set values for hidden inputs on form submission
        document.getElementById('booking-form').addEventListener('submit', function(event) {
            document.getElementById('hidden_check_in_date').value = document.getElementById('check_in_date').value;
            document.getElementById('hidden_check_out_date').value = document.getElementById('check_out_date')
                .value;
        });

        // Sort reviews based on selection
        document.getElementById('sortReviews').addEventListener('change', function(event) {
            const selectedOption = event.target.value;
            const reviewsContainer = document.getElementById('reviews');
            const reviews = Array.from(reviewsContainer.querySelectorAll('.review'));

            reviews.sort((a, b) => {
                const aRating = parseInt(a.querySelector('.review-rating').textContent);
                const bRating = parseInt(b.querySelector('.review-rating').textContent);
                return selectedOption === 'highest' ? bRating - aRating : aRating - bRating;
            });

            reviews.forEach(review => reviewsContainer.appendChild(review));
        });

        function toggleContent(element) {
            const content = element.nextElementSibling;

            // Nếu nội dung đang ẩn, hiển thị nó; nếu đang hiển thị, ẩn nó
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                element.querySelector('i').classList.replace('bi-chevron-down', 'bi-chevron-up');
            } else {
                content.classList.add('hidden');
                element.querySelector('i').classList.replace('bi-chevron-up', 'bi-chevron-down');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sortReviews');
            const reviewsContainer = document.getElementById('reviewsContainer');

            sortSelect.addEventListener('change', function() {
                const sortOption = this.value;
                const currentUrl = new URL(window.location.href);

                currentUrl.searchParams.set('sortOption', sortOption);
                currentUrl.searchParams.set('page', 1);

                loadReviews(currentUrl.toString());
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination-link')) {
                    e.preventDefault();

                    const url = e.target.closest('.pagination-link').href;
                    const newUrl = new URL(url);

                    const sortOption = sortSelect.value;
                    newUrl.searchParams.set('sortOption', sortOption);

                    loadReviews(newUrl.toString());
                }
            });

            // Hàm tải đánh giá
            function loadReviews(url) {
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        reviewsContainer.innerHTML = data.html;
                        reviewsContainer.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                        });
                    })
                    .catch((error) => console.error('Error fetching reviews:', error));
            }
        });

        function scrollToRooms(event) {
            event.preventDefault();

            const roomsSection = document.getElementById('available-rooms');
            if (roomsSection) {
                roomsSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
        let modalOverlayElement = document.getElementById('modalOverlay');
        let closeModalButton = document.getElementById('closeModalBtn');
        let slideshowElement = document.getElementById('slideshow');
        let closeSlideshowButton = document.getElementById('closeSlideshowBtn');
        let slideshowImages = document.querySelectorAll('.slideshow-image');
        let slideCounterElement = document.getElementById('slideCounter');
        let currentSlideIndex = 0;

        // Mở modal khi nhấn vào ảnh
        document.querySelectorAll('.openModal').forEach((img, index) => {
            img.addEventListener('click', () => {
                openModalDestinationImage();
            });
        });

        // Đóng modal khi nhấn nút "Đóng"
        closeModalButton.addEventListener('click', () => {
            closeModalDestinationImage();
        });

        // Đóng modal khi nhấn vào overlay bên ngoài modal
        modalOverlayElement.addEventListener('click', (e) => {
            if (e.target === modalOverlayElement) {
                closeModalDestinationImage();
            }
        });

        // Đóng modal hoặc slideshow khi nhấn phím Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModalDestinationImage();
                closeSlideshow();
            }
        });

        // Mở modal
        function openModalDestinationImage() {
            modalOverlayElement.classList.remove('hidden'); // Hiển thị modal
        }

        // Mở slideshow
        function openSlideshow(index) {
            currentSlideIndex = index;
            updateSlideshow();
            slideshowElement.classList.remove('hidden'); // Hiển thị slideshow
        }

        // Cập nhật nội dung slideshow
        function updateSlideshow() {
            slideshowImages.forEach((img, index) => {
                img.classList.remove('active');
                img.classList.add('hidden'); // Thêm dòng này để ẩn tất cả hình ảnh
                if (index === currentSlideIndex) {
                    img.classList.add('active');
                    img.classList.remove('hidden'); // Hiển thị hình ảnh hiện tại
                }
            });
            slideCounterElement.textContent = (currentSlideIndex + 1) + " / " + slideshowImages.length;
        }

        // Đóng slideshow
        function closeSlideshow() {
            slideshowElement.classList.add('hidden');
        }

        // Đóng modal
        function closeModalDestinationImage() {
            modalOverlayElement.classList.add('hidden');
        }

        // Chuyển sang slide trước
        document.getElementById('prevSlide').addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex > 0) ? currentSlideIndex - 1 : slideshowImages.length - 1;
            updateSlideshow();
        });

        // Chuyển sang slide tiếp theo
        document.getElementById('nextSlide').addEventListener('click', () => {
            currentSlideIndex = (currentSlideIndex < slideshowImages.length - 1) ? currentSlideIndex + 1 : 0;
            updateSlideshow();
        });

        // Đóng slideshow khi nhấn nút "Đóng slideshow"
        closeSlideshowButton.addEventListener('click', () => {
            closeSlideshow();
        });
        document.getElementById('bookNowButton').addEventListener('click', function() {
            modalOverlayElement.classList.add('hidden');
            document.getElementById('available-rooms').scrollIntoView({
                behavior: 'smooth'
            });
            closeModalDestinationImage();
        });

        function resetModal() {
            currentSlideIndex = 0; // Đặt lại chỉ số slide
            updateSlideshow(); // Cập nhật slideshow
        }
        document.querySelectorAll('.openModal').forEach((img, index) => {
            img.addEventListener('click', function() {
                resetModal(); // Reset trạng thái trước khi mở
                openModalDestinationImage();
            });
        });

        function moModalImage(roomId) {
            document.querySelectorAll('.modal-container').forEach(modal => {
                modal.classList.add('hidden');
            });

            document.getElementById('modal_container_' + roomId).classList.remove('hidden');
        }

        // Hàm đóng modal
        function dongModal(roomId) {
            document.getElementById('modal_container_' + roomId).classList.add('hidden');
        }

        let currentImageIndex = 0;

        function changeImage(roomId, direction) {
            let images = document.querySelectorAll(
                `#modal_container_${roomId} .small-image`);
            let mainImage = document.getElementById(`mainImage_${roomId}`);

            currentImageIndex += direction;

            if (currentImageIndex < 0) currentImageIndex = images.length - 1;
            if (currentImageIndex >= images.length) currentImageIndex = 0;

            mainImage.src = images[currentImageIndex].src;
        }

        function setMainImage(roomId, index) {
            let images = document.querySelectorAll(
                `#modal_container_${roomId} .small-image`);
            let mainImage = document.getElementById(`mainImage_${roomId}`);
            mainImage.src = images[index].src;
        }

        // nav active
        document.querySelectorAll("ul li a").forEach(button => {
            button.addEventListener("click", function() {
                document.querySelectorAll("ul li a").forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
            });
        });

        //carousel
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('carousel');
            const items = document.querySelectorAll('.carousel-item-cmt');
            const prevButton = document.getElementById('prev-button');
            const nextButton = document.getElementById('next-button');

            let scrollPosition = 0;
            const itemWidth = items[0].offsetWidth + 8;

            nextButton.addEventListener('click', () => {
                const maxScroll = carousel.scrollWidth - carousel.clientWidth;

                // Tăng vị trí cuộn
                scrollPosition = Math.min(scrollPosition + itemWidth, maxScroll);
                carousel.scrollTo({
                    left: scrollPosition,
                    behavior: 'smooth'
                });

                toggleButtons(maxScroll);
            });

            prevButton.addEventListener('click', () => {
                scrollPosition = Math.max(scrollPosition - itemWidth, 0);
                carousel.scrollTo({
                    left: scrollPosition,
                    behavior: 'smooth'
                });

                toggleButtons(carousel.scrollWidth - carousel.clientWidth);
            });

            function toggleButtons(maxScroll) {
                prevButton.disabled = scrollPosition <= 0;
                nextButton.disabled = scrollPosition >= maxScroll;
            }

            toggleButtons(carousel.scrollWidth - carousel.clientWidth);
        });
    </script>
@endpush
@push('style')
    <style>
        html {
            scroll-behavior: smooth;
        }

        .modal-container {
            transition: opacity 0.3s ease-in-out;
        }

        .hidden {
            display: none;
            opacity: 0;
        }

        .modal-container {
            width: 800px;
            height: 500px;
        }

        /* Ảnh chính */
        .main-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Ảnh nhỏ (thu nhỏ dọc) */
        .small-image {
            width: 60px;
            height: 60px;
        }

        .slideshow-container {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            margin: auto;
        }

        .slideshow-image {
            width: 100%;
            height: auto;
            display: none;
        }

        .active {
            display: block;
        }

        .hidden {
            display: none;
        }
    </style>
@endpush
