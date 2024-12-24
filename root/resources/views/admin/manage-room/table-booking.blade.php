@foreach ($bookings as $booking)
    <tr class="text-gray-700 dark:text-gray-100">
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $booking->guest_details['transaction_id'] }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            {{ $booking->guest_details['full_name_guest'] }}
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $booking->guest_details['phone_number'] }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            {{ $booking->room_booking_detail[0]['room_name'] }}...</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $booking->guest_details['time_check_in'] }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $booking->room_booking_detail[0]['room_quantity'] }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $booking->room_booking_detail[0]['price_per_night'] }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            @if ($booking->roomListBookings->first()->status === COMPLETED)
                <button type='button'
                    class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20'>
                    <span class=''>{{ __('content.manage-booking.completed') }}</span>
                </button>
            @elseif($booking->roomListBookings->first()->status === ACTIVE)
                <button type='button'
                    class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-[#eda515] uppercase rounded-md select-none whitespace-nowrap bg-[#eda515]/20'>
                    <span class=''>{{ __('content.manage-booking.active') }}</span>
                </button>
            @else
                <button type='button'
                    class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-red-900 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20'>
                    <span class=''>{{ __('content.manage-booking.canceled') }}</span>
                </button>
            @endif
        </td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <button
                class='relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                type='button'>
                <a href="{{ route('admin.manage.detailOrder', ['id' => $booking->id]) }}"><i
                        class="ri-eye-line text-xl"></i></a>
            </button>
            @if ($booking->roomListBookings->first()->status === ACTIVE)
                <button
                    onclick="openModal('modal-id', {{ $booking->id }}, '{{ $booking->roomListBookings->first()->status }}')"
                    class='relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                    type='button'>
                    <span class='absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor' aria-hidden='true'
                            class='w-4 h-4'>
                            <path
                                d='M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z'>
                            </path>
                        </svg>
                    </span>
                </button>
            @endif
        </td>
    </tr>
@endforeach
@include('admin.manage-room.modal-booking')
