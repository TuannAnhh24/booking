@foreach ($roomList as $room)
    <tr class="text-gray-700 dark:text-gray-100">
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            {{ $room->room->name ?? "-" }}
        </td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            {{ $room->room->guest_quantity ?? "-"}}
        </td>
        @php
            $isBooked = false;
            $currentDateTime = now();
            $bookingDetails = null;
            foreach ($room->roomListBookings as $booking) {
                if ($booking->available_from <= $currentDateTime && $booking->available_to >= $currentDateTime) {
                    $isBooked = true;
                    $bookingDetails = $booking->booking;
                    break;
                }
            }
        @endphp
        @if ($isBooked && $bookingDetails)
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                {{ $bookingDetails->guest_details['full_name_guest'] }}
            </td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                {{ $bookingDetails->guest_details['phone_number'] }}
            </td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                {{ $booking->available_from }} - {{ $booking->available_to }}
            </td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                @php
                    $room_id = $room->room->id;
                    $dataRoomDetails = $bookingDetails->room_booking_detail;
                    $data = collect($dataRoomDetails)->where('room_id', $room_id);
                    // $data = collect($dataRoomDetails)->where('room_id', $room_id)->first();
                @endphp
                @foreach ($data as $roomData)
                    {{ $roomData['price_per_night'] }}
                @endforeach
                {{-- {{ $data['price_per_night'] }} --}}
            </td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <button type='button' class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-red-900 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20'>
                    <span>{{ __('content.manage-room.Booked') }}</span>
                </button>
            </td>
        @else
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">-</td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">-</td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">-</td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">-</td>
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <button type='button' class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20'>
                <span>{{ __('content.manage-room.Available') }}</span>
            </button>
            </td>
        @endif
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <button class='relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none' type='button'>
                    <a href="{{ route('admin.manage.detailRoom', ['id' => $room->id]) }}"><i class="ri-eye-line text-xl"></i></a>
                </button>
                {{-- <button onclick="openModal('modal-id', {{ $room->id }}, '{{ $room->room->name }}')" class='relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none' type='button'>
                        <span class='absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' aria-hidden='true' class='w-4 h-4'>
                                <path d='M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z'></path>
                            </svg>
                        </span>
                </button> --}}
            </td>
    </tr>
@endforeach