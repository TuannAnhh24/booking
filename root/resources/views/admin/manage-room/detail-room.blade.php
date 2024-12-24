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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
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
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.payer_email') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['payer_email'] ?? __('content.manage-room.no_yes') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.payment_method') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium text-gray-400">{{ __('content.manage-room.online_paypal') }}</span>
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
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['promotion_details'] ?? __('content.manage-room.no_yes') }}</span>
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
                        <div class="text-2xl font-semibold">{{ __('content.manage-room.customer_details') }}</div>
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
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.full_name_guest') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{ $booking->guest_details['last_name_user_account'] ?? __('content.manage-room.no_yes') }} {{ $booking->guest_details['first_name_user_account'] ?? __('content.manage-room.no_yes') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.email_guest') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['email_user_account'] ?? __('content.manage-room.no_yes') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.phone_number') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{$booking->guest_details['phone_number'] ?? __('content.manage-room.no_yes') }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">{{ __('content.manage-room.infor_room') }}</div>
                </div>
            </div>
            <div class="overflow-hidden">
                <table class="w-full min-w-[540px]">
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.typeRoom') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{ $room->room->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.guest_quantity') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <span
                                    class="text-[13px] font-medium text-gray-400">{{ $room->room->guest_quantity }} {{ __('content.manage-room.user_guest') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ __('content.manage-room.status_order') }}</a>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                @if ($isRoomAvailable)
                                    <button type='button' class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20'>
                                        <span class=''>{{ __('content.manage-room.Available') }}</span>
                                    </button>   
                                @else   
                                    <button type='button' class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-red-900 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20'>
                                        <span class=''>{{ __('content.manage-room.Booked') }}</span>
                                    </button>
                                @endif
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
                <div class="font-medium">{{ __('content.manage-room.address') }}</div>
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
                                    class="text-[13px] font-medium text-gray-400">{{ $room->room->destinations->name }}</span>
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
                                    class="text-[13px] font-medium text-gray-400">{{ $room->room->destinations->locations->pluck('name')->implode(', ') }}</span>
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
                                    class="text-[13px] font-medium text-gray-400">{{ $room->room->destinations->detailed_address }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">{{ __('content.manage-room.customer') }}</div>
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
                <div class="font-medium">{{ __('content.manage-room.detail_order') }} (#{{$booking->guest_details['transaction_id'] ?? __('content.manage-room.no_yes')}})</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[460px]">
                    <thead>
                        <tr>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                {{ __('content.manage-room.typeRoom') }}</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                {{ __('content.manage-room.available_from') }}</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-room.available_to') }}</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-room.price_night') }}</th>
                            {{-- <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                {{ __('content.manage-room.total_price') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b border-b-gray-50">
                                <div class="flex items-center">
                                    <img src="{{ $room->room->images->isNotEmpty() ? Storage::url($room->room->images->first()->image) : __('content.manage-room.no_yes') }}" alt="" class="w-8 h-8 rounded object-cover block">
                                    <a href="#"
                                        class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate"> {{ $room->room->name }}</a>
                                </div>
                            </td>
                            @php
                                $room_id = $room->room->id;
                                $data = collect();
                                if ($booking) {
                                    $dataRoomDetails = $booking->room_booking_detail;
                                    $data = collect($dataRoomDetails)->where('room_id', $room_id);
                                } 
                            @endphp
                            @if($data->isEmpty())
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium">{{__('content.manage-room.no_yes') }}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium ">{{__('content.manage-room.no_yes')}}</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium ">{{__('content.manage-room.no_yes')}}</span>
                                </td>
                            @else
                                @foreach($data as $roomData)
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium">{{ $roomData['available_from'] ?? __('content.manage-room.no_yes') }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium ">{{ $roomData['available_to'] ?? __('content.manage-room.no_yes')}}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium ">{{ $roomData['price_per_night'] ?? __('content.manage-room.no_yes')}}</span>
                                    </td>
                                @endforeach
                            @endif
                            {{-- <td class="py-2 px-4 border-b border-b-gray-50">
                                <span class="text-[13px] font-medium ">{{ $booking->total_price ?? __('content.manage-room.no_yes')}}</span>
                            </td> --}}
                        </tr>
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