<div class="list-item-container lg:col-span-5">
    <div class="text-xl font-bold text-[#1a1a1a]">
        {{ $locationName }}: {{ __('content.search.title1') }} {{ $totalHotels }} {{ __('content.search.title2') }}
    </div>
    @foreach ($hotels as $hotel)
        <div
            class=" block bg-white border rounded-lg mt-6 group-hover:shadow-lg transition-shadow duration-300 cursor-pointer">
            <div class="p-4">
                <div class="grid grid-cols-1 gap-3 lg:grid-cols-11">
                    <div class="lg:col-span-4 relative">
                        <a
                            href="{{ route('hotel-details', ['id' => $hotel->id]) }}?destination_id={{ $hotel->id }}&check_in_date={{ request('check_in') }}&check_out_date={{ request('check_out') }}&guest_count={{ request('people_old') }}">
                            <div class="pt-[100%] object-cover bg-center rounded-lg"
                                style="
                                background-image: url('{{ $hotel->images->isNotEmpty()
                                    ? asset('storage/' . $hotel->images->first()->image)
                                    : asset('images/default-hotel.jpg') }}');">
                            </div>
                        </a>
                    </div>
                    <div class="lg:col-span-7">
                        <div class="flex justify-between gap-1">
                            <div class="flex flex-col flex-wrap">
                                <a href="{{ route('hotel-details', ['id' => $hotel->id]) }}?destination_id={{ $hotel->id }}&check_in_date={{ request('check_in') }}&check_out_date={{ request('check_out') }}&guest_count={{ request('people_old') }}"
                                    class="text-xl max-w-[295px] font-bold text-[#006CE4]">
                                    {{ $hotel->name }}
                                </a>
                                <div class="flex text-xs">
                                    <div
                                        class="after:content-['·'] after:text-[#e7e7e7] after:py-0 after:px-[5px] after:font-extrabold after:scale-150 text-[#006ce4]">
                                        @foreach ($hotel->locations as $location)
                                            @foreach ($location->locationDestinations as $locationDestination)
                                                @php
                                                    $destination_id = $hotel->id;
                                                    $locationDestination_Destination_id =
                                                        $locationDestination->destination_id;
                                                @endphp
                                                @if ($destination_id == $locationDestination_Destination_id)
                                                    <p class="ml-2">
                                                        {{ $locationDestination->destination->detailed_address }}</p>
                                                    <p class="ml-2">{{ $locationDestination->address }}</p>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <div class="flex gap-1 items-center">
                                    <div class="flex flex-col">
                                        @php
                                            $avgRating = number_format($hotel->reviews->first()->avg_rating ?? 0, 1);
                                        @endphp
                                        @if ($avgRating > 9)
                                            <div class="text-sm font-bold">{{ __('content.search.excellent') }}</div>
                                        @elseif($avgRating >= 7)
                                            <div class="text-sm font-bold">{{ __('content.search.good') }}</div>
                                        @elseif($avgRating >= 5)
                                            <div class="text-sm font-bold">{{ __('content.search.average') }}</div>
                                        @else
                                            <div class="text-sm font-bold">{{ __('content.search.poor') }}</div>
                                        @endif
                                        <div class="text-xs">
                                            {{ $hotel->reviews->first()->review_count ?? 0 }}
                                            {{ __('content.search.reviews') }}
                                        </div>
                                    </div>
                                    <div class="">
                                        <span
                                            class="px-[0.60rem] py-[0.45rem] bg-[#003b95] rounded-t-lg rounded-br-lg text-white text-center font-semibold">
                                            {{ number_format($hotel->reviews->first()->avg_rating ?? 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- phần 2 -->
                        <div class="flex justify-start my-2">
                        </div>
                        <!-- phần phần 3 -->
                        <div class="flex justify-between gap-2">
                            <div class="w-[60%] mt-3">
                                <div class="text-xs font-bold">
                                    @php
                                        $hasAvailableRoom = false;
                                        $startTime = \Carbon\Carbon::parse(request('check_in'));
                                        $endTime = \Carbon\Carbon::parse(request('check_out'));
                                    @endphp

                                    @foreach ($hotel->rooms as $room)
                                        @php
                                            $availableRoom = $room->roomLists
                                                ->filter(function ($roomList) use ($startTime, $endTime) {
                                                    return $roomList->bookings
                                                        ->where(function ($booking) use ($startTime, $endTime) {
                                                            return $booking->available_from <= $endTime &&
                                                                $booking->available_to >= $startTime &&
                                                                !$booking->deleted_at;
                                                        })
                                                        ->isEmpty();
                                                })
                                                ->first();

                                            if ($availableRoom) {
                                                $hasAvailableRoom = true;
                                            }
                                            $cheapestPrice = $room->variants->min('pivot.price_per_night');
                                        @endphp

                                        @if ($hasAvailableRoom)
                                            @if ($cheapestPrice)
                                                <a
                                                    href="{{ route('hotel-details', ['id' => $hotel->id]) }}?destination_id={{ $hotel->id }}&check_in_date={{ request('check_in') }}&check_out_date={{ request('check_out') }}&guest_count={{ request('people_old') }}">{{ $room->name }}</a>
                                            @endif
                                        @break
                                    @endif
                                @endforeach

                            </div>
                            <ul class="flex flex-wrap mt-2">
                                @php
                                    $hasAvailableRoom = false;
                                    $startTime = \Carbon\Carbon::parse(request('check_in'));
                                    $endTime = \Carbon\Carbon::parse(request('check_out'));
                                @endphp

                                @foreach ($hotel->rooms as $room)
                                    @php
                                        $availableRoom = $room->roomLists
                                            ->filter(function ($roomList) use ($startTime, $endTime) {
                                                return $roomList->bookings
                                                    ->where(function ($booking) use ($startTime, $endTime) {
                                                        return $booking->available_from <= $endTime &&
                                                            $booking->available_to >= $startTime &&
                                                            !$booking->deleted_at;
                                                    })
                                                    ->isEmpty();
                                            })
                                            ->first();

                                        if ($availableRoom) {
                                            $hasAvailableRoom = true;
                                        }
                                        $cheapestPrice = $room->variants->min('pivot.price_per_night');
                                    @endphp

                                    @if ($hasAvailableRoom)
                                        @if ($cheapestPrice)
                                            @foreach ($room->variants as $variant)
                                                <li
                                                    class="pb-[3px] text-xs after:content-['·'] after:text-black after:py-0 after:px-[5px] after:font-extrabold after:scale-150">
                                                    {{ $variant->name }}
                                                </li>
                                            @endforeach
                                        @endif
                                    @break
                                @endif
                            @endforeach

                        </ul>
                        <!-- text green -->
                        <div class="flex flex-col my-2">
                            <div class="flex mb-1">
                                <svg class="h-4 w-4 text-[#008234] mr-2" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                <span
                                    class="text-[#008234] text-xs">{{ __('content.search.free_cancel') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end w-[40%]">

                        @php
                            $hasAvailableRoom = false;
                            $startTime = \Carbon\Carbon::parse(request('check_in'));
                            $endTime = \Carbon\Carbon::parse(request('check_out'));
                        @endphp
                        @foreach ($hotel->rooms as $room)
                            @php
                                $availableRoom = $room->roomLists
                                    ->filter(function ($roomList) use ($startTime, $endTime) {
                                        return $roomList->bookings
                                            ->where(function ($booking) use ($startTime, $endTime) {
                                                return $booking->available_from <= $endTime &&
                                                    $booking->available_to >= $startTime &&
                                                    !$booking->deleted_at;
                                            })
                                            ->isEmpty();
                                    })
                                    ->first();

                                if ($availableRoom) {
                                    $hasAvailableRoom = true;
                                }
                                $cheapestPrice = $room->variants->min('pivot.price_per_night');
                            @endphp

                            @if ($hasAvailableRoom)
                                @if ($cheapestPrice)
                                    <div class="text-xs mb-1">
                                        {{ __('content.search.1n2p') }}{{ $room->guest_quantity }}
                                        {{ __('content.search.people') }}
                                    </div>
                                    @if (auth()->check())
                                        <div class="text-xs line-through text-[#d4111e] mb-1">
                                            {{ number_format($cheapestPrice, 0, ',', '.') }} VND
                                        </div>
                                        <div class="text-xl font-semibold mb-1">
                                            {{ number_format($cheapestPrice * 0.98, 0, ',', '.') }} VND
                                        </div>
                                    @else
                                        <div class="text-xs line-through text-[#d4111e] mb-1">
                                            {{ number_format($cheapestPrice, 0, ',', '.') }} VND
                                        </div>
                                        <div class="text-xl font-semibold mb-1">
                                            {{ number_format($cheapestPrice * 1.08, 0, ',', '.') }} VND
                                        </div>
                                    @endif
                                @break
                            @endif
                        @endif
                    @endforeach
                    <div class="text-xs mb-3">{{ __('content.search.tax') }}</div>
                    <div class="flex items-center py-2 px-3 bg-[#006ce4] rounded-md flex-nowrap">
                        <a href="{{ route('hotel-details', ['id' => $hotel->id]) }}?destination_id={{ $hotel->id }}&check_in_date={{ request('check_in') }}&check_out_date={{ request('check_out') }}&guest_count={{ request('people_old') }}"
                            class="text-sm text-white">
                            {{ __('content.search.button') }}
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-4 h-4 pl-2">
                            <path fill="white"
                                d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                            </path>
                        </svg>
                    </div>
                    @if (!auth()->check())
                        <div class="text-xs mb-3 mt-1">
                            <a href="{{ route('login') }}"
                                class="hover:text-blue-500 hover:underline">({{ __('content.search.logins') }})</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach
{{ $hotels->links('client.searchresults.layouts-search.pagination') }}
</div>
