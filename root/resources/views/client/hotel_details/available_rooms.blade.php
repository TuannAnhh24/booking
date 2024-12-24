@if ($destination->rooms->isEmpty())
    <p class="text-center text-gray-500 mt-4">
        {{ __('content.hotel_detail.no_hotel_available') }}
    </p>
@else
    <table class="min-w-full border-b border-blue-400">
        <thead class="sticky top-0 bg-blue-700 text-white z-10">
            <tr>
                <th class="text-sm border-t border-b border-l-0 border-r-0 border-blue-400 px-4 w-[264px]">
                    {{ __('content.hotel_detail.accommodation_type') }}
                </th>
                <th class="text-sm border border-blue-400 px-4 py-2 w-[140px]">
                    {{ __('content.hotel_detail.number_of_guest') }}
                </th>
                <th class="text-sm border border-blue-400 px-4 py-2 w-[174px]">
                    {{ __('content.hotel_detail.price_for_n_nights', ['n' => $numberOfNights]) }}
                </th>
                <th class="text-sm border border-blue-400 px-4 py-2 w-[264px]">
                    {{ __('content.hotel_detail.options') }}
                </th>
                <th class="text-sm border border-blue-400 px-4 py-2 w-[140px]">
                    {{ __('content.hotel_detail.select_quantity') }}
                </th>
                <th class="text-sm border border-blue-400 px-4 py-2 w-[220px]">
                    {{ __('content.hotel_detail.action') }}
                </th>
            </tr>
        </thead>
        <tbody>
            <form id="booking-form" action="{{ route('booking.details', ['roomId' => $destination->id]) }}"
                method="GET">
                @csrf
                <!-- Chọn số lượng phòng -->
                <input type="hidden" name="check_in_date" id="hidden_check_in_date">
                <input type="hidden" name="check_out_date" id="hidden_check_out_date">

                @foreach ($destination->rooms as $index => $room)
                    @php
                        $originalPrice = $room->variants->isNotEmpty() ? $room->variants->first()->price_per_night : 0;
                        $discountedPrice = auth()->check() ? $originalPrice * 0.9 : $originalPrice;
                        $totalPrice = $numberOfNights * $discountedPrice;
                        $tax = $numberOfNights * $originalPrice * 0.08;
                        $finalPrice = $totalPrice + $tax;
                        $isAuthenticated = auth()->check();
                    @endphp
                    <tr>
                        <!-- Loại chỗ nghỉ -->
                        <td class="py-3 border-t border-b border-l-0 border-r-0 border-blue-400 space-y-3 align-top">
                            <div class="ml-3">
                                <div onclick="moModalImage({{ $room->id }})" class="relative cursor-pointer">
                                    <p class="text-blue-500 font-bold text-xl hover:underline">
                                        <span>{{ $room->name }}</span>
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- Số lượng khách -->
                        <td class="py-3 border border-blue-400 space-x-1 align-top">
                            <div class="ml-2">
                                @for ($i = 0; $i < $room->guest_quantity; $i++)
                                    <i class="bi bi-person-fill text-xl"></i>
                                @endfor
                            </div>
                        </td>
                        <!-- Giá cho 1 đêm -->
                        <td class="border border-blue-400 align-top py-3">
                            <div class="ml-2 space-y-4">
                                <div class="price-display">
                                    @guest
                                        <div class="font-bold text-xl">
                                            VND {{ number_format($totalPrice, 0, ',', '.') }}
                                        </div>
                                    @endguest

                                    @auth
                                        <div>
                                            <span class="text-red-600 line-through">VND
                                                {{ number_format($originalPrice * $numberOfNights, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <div class="font-bold text-xl text-green-700">
                                            VND {{ number_format($totalPrice, 0, ',', '.') }}
                                        </div>
                                    @endauth
                                    <div class="text-gray-500 text-base">
                                        {{ __('content.hotel_detail.tax_and_fees') }} (8%) + VND
                                        {{ number_format($tax, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="border border-blue-400 align-top space-y-3 py-3">
                            @if ($room->variants->isNotEmpty())
                                @foreach ($room->variants as $variant)
                                    <div class="inline-block mr-2 mb-1">
                                        <span class="text-xs font-semibold text-green-500 ml-3">✓</span>
                                        <span class="text-xs font-semibold">{{ $variant->name }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="mt-2">
                                    <span class="text-gray-500">
                                        {{ __('content.hotel_detail.no_room_types_available') }}
                                    </span>
                                </div>
                            @endif
                        </td>

                        <!-- Chọn số lượng phòng -->
                        <td class="border border-blue-400 align-top py-3 w-auto" id="room_td_{{ $room->id }}">
                            <div class="flex justify-center items-center px-2">
                                @if ($room->roomLists->count() > 0)
                                    <select name="room_quantity[{{ $room->id }}]"
                                        id="room_quantity_{{ $room->id }}"
                                        class="p-2 rounded room-select w-full text-base"
                                        data-room-id="{{ $room->id }}" data-original-price="{{ $originalPrice }}"
                                        data-nights="{{ $numberOfNights }}"
                                        data-is-authenticated="{{ auth()->check() ? '1' : '0' }}" style="width: 100%;">
                                        @for ($i = 0; $i <= $room->roomLists->count(); $i++)
                                            @php
                                                $itemTotalPrice = $i * $totalPrice;
                                            @endphp
                                            <option value="{{ $i }}"
                                                data-display-text="{{ $i }}"
                                                data-price="{{ $itemTotalPrice }}">
                                                {{ $i }}
                                                @if ($i > 0)
                                                    (VND {{ number_format($itemTotalPrice, 0, ',', '.') }})
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                @else
                                    <p class="text-red-600 text-sm font-semibold">
                                        {{ __('content.hotel_detail.no_rooms_available') }}
                                    </p>
                                @endif
                            </div>
                            <p class="text-red-600 text-sm mt-2 hidden px-2" id="warning_{{ $room->id }}">
                                {{ __('content.hotel_detail.please_select_at_least_one_room') }}
                            </p>
                        </td>
                        <!-- Nút hành động chỉ có ở hàng đầu tiên -->
                        @if ($index === 0)
                            <td class="border-t border-l-0 border-r-0 align-top py-3 bg-blue-50"
                                rowspan="{{ $destination->rooms->count() }}">
                                <div class="p-4 rounded-lg text-center space-y-4 justify-between">
                                    <div class="font-semibold text-lg hidden" id="booking_summary">
                                        <span id="total_rooms">0</span>
                                        {{ __('content.hotel_detail.apartments_price') }}
                                    </div>

                                    <div id="original_price" class="text-red-600 line-through hidden">VND 0</div>

                                    <div id="discounted_price" class="font-bold text-2xl text-green-700 hidden">VND 0
                                    </div>

                                    <div class="text-gray-500 hidden" id="tax_and_fee">
                                        {{ __('content.hotel_detail.including_tax_and_fees') }}
                                    </div>

                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 font-bold booking-btn rounded-lg cursor-pointer"
                                        id="booking_btn" disabled>
                                        {{ __('content.hotel_detail.i_will_put') }}
                                    </button>

                                    <div class="text-sm text-gray-600 mt-4 space-y-1">
                                        <p>{{ __('content.hotel_detail.only_takes_2_minutes') }}</p>
                                        <p>{{ __('content.hotel_detail.instant_confirmation') }}</p>
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </form>
        </tbody>
    </table>
@endif
