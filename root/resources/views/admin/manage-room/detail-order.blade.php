@extends('admin.layouts.master-layout')
@section('content')
<style>
    #text-container {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    #text-content {
        display: block;
        max-width: 500px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        word-wrap: break-word;
    }

    #text-content.expanded {
        white-space: normal; 
        text-overflow: unset; 
        overflow: unset;
    }
</style>
<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold"> {{ __('content.manage-room.detail_booking') }}</div>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden">
                <table class="w-full min-w-[540px]">
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-booking.payer_email') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['payer_email']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-booking.payment_method') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{ __('content.manage-booking.online_paypal') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.promotion') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['promotion_details']['code'] ?? __('content.manage-room.no_yes')}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-booking.total_price') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{ $booking->total_price }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">{{ __('content.manage-booking.customer_details') }}</div>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden">
                <table class="w-full min-w-[540px]">
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-booking.full_name_guest') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['last_name_user_account'] ?? __('content.manage-room.no_yes')}} {{$booking->guest_details['first_name_user_account'] ?? __('content.manage-room.no_yes')}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-booking.email_guest') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['email_user_account'] ?? __('content.manage-room.no_yes')}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-booking.phone_number') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['phone_number']}}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">{{ __('content.manage-booking.address') }}</div>
            </div>
            <div class="overflow-hidden">
                <table class="w-full min-w-[540px]">
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.name') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->room_booking_detail[0]['destinations_name']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.city') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->room_booking_detail[0]['location_destination_address']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.detail_address') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->room_booking_detail[0]['destinations_detailed_address']}}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">{{ __('content.manage-booking.customer') }}</div>
            </div>
            <div class="overflow-hidden">
                <table class="w-full min-w-[540px]">
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.full_name') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['full_name_guest'] ?? __('content.manage-room.no_yes') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.email') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['email_guest'] ?? __('content.manage-room.no_yes') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.time') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['time_check_in'] ?? __('content.manage-room.no_yes') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#" class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.notpad') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div id="text-container" class="flex items-center">
                                    <span class="text-[13px] font-medium text-gray-400" id="text-content">
                                        {{$booking->take_note ?? __('content.manage-room.no_yes') }}
                                    </span>
                                    <button id="toggle-button" class="text-blue-500 text-[13px] font-medium ml-2">View More</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-3 w-full">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">{{ __('content.manage-booking.detail_order') }} (#{{$booking->guest_details['transaction_id']}})</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                {{ __('content.manage-booking.typeRoom') }}</th>
                             <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-booking.price') }}</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-booking.guest_quantity') }}</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                {{ __('content.manage-booking.available_from') }}</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-booking.available_to') }}</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-booking.quantity') }}</th>
                            {{-- <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-booking.total_price') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($booking->room_booking_detail as $roomData)
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <img src="{{ Storage::url($roomData['room_image'][0]) }}" alt=""
                                            class="w-8 h-8 rounded object-cover block">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate"> {{ $roomData['room_name'] }}</a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium">{{ $roomData['price_per_night'] }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium">{{ $roomData['guest_quantity'] }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium">{{ $roomData['available_from'] }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium ">{{ $roomData['available_to'] }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium ">{{ $roomData['room_quantity'] }}</span>
                                </td>
                                {{-- <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium ">{{ $booking->total_price }}</span>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</div>
<!-- End Content -->
@endsection
@push('scripts')
<script src="{{ asset('js/admin/dashboard.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const textContent = document.getElementById('text-content');
    const toggleButton = document.getElementById('toggle-button');
    function checkTextOverflow() {
        if (textContent.scrollWidth > textContent.clientWidth) {
            toggleButton.style.display = 'inline'; 
        } else {
            toggleButton.style.display = 'none';
        }
    }
    checkTextOverflow();
    toggleButton.addEventListener('click', function () {
        const isExpanded = textContent.classList.toggle('expanded');
        this.textContent = isExpanded ? 'View Less' : 'View More';
    });
});
</script>
@endpush
