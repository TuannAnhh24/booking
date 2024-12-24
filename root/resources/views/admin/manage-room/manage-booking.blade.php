@extends('admin.layouts.master-layout')
@section('content')
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
            <div
                class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class='flex items-center justify-between gap-8 mb-8'>
                        <div>
                            <h5
                                class='block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900'>
                                {{ __('content.manage-booking.manage') }}
                            </h5>
                        </div>

                        <div class='flex flex-col gap-2 shrink-0 sm:flex-row'>
                            <div class='w-full md:w-72'>
                                <div class='relative h-10 w-full min-w-[200px]'>
                                    <div
                                        class='absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500'>
                                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'
                                            strokeWidth='1.5' stroke='currentColor' aria-hidden='true' class='w-5 h-5'>
                                            <path strokeLinecap='round' strokeLinejoin='round'
                                                d='M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z'>
                                            </path>
                                        </svg>
                                    </div>
                                    <form id="searchForm" method="GET" action="{{ route('admin.manage.manageBooking') }}">
                                        <input id="search" name="keyword"
                                            class='peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50'
                                            placeholder='{{ __('content.manage-booking.transaction_id') }}' value="{{ old('keyword', request('keyword')) }}"/>
                                        <label
                                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all">
                                            {{ __('content.user.search') }}
                                        </label>
                                    </form>
                                </div>
                            </div>

                            <!-- Button -->
                            <button type="button"
                                class="dropdown-toggle select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-modal-target="advancedSearchModal" data-modal-toggle="advancedSearchModal">
                                <i class="ri-more-2-fill"></i>
                            </button>

                            <!-- Modal -->
                            <div id="advancedSearchModal" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-lg max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal Header -->
                                        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ __('content.manage-room.advanced_Search') }}
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="advancedSearchModal">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="p-6">
                                            <!-- Search Form -->
                                            <form method="GET" id="advancedSearchForm" action="{{ route('admin.manage.manageBooking') }}" >
                                                @csrf
                                                <div class="grid grid-cols-2 gap-4">
                                                    <!-- Loại phòng -->
                                                    <div>
                                                        <label for="roomType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('content.manage-room.typeRoom') }}</label>
                                                        <select id="roomType" name="roomType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="">{{ __('content.manage-room.all') }}</option>
                                                            @foreach($rooms as $room)
                                                                <option value="{{ $room->name }}" 
                                                                    {{ (old('roomType') == $room->name || request('roomType') == $room->name) ? 'selected' : '' }}>
                                                                    {{ $room->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!-- keyword -->
                                                    <div>
                                                        <label for="transaction_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('content.manage-booking.order_id') }}</label>
                                                        <input type="text" id="transaction_id" name="transaction_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="{{ __('content.manage-booking.transaction_id') }}" value="{{ old('transaction_id', request('transaction_id')) }}" >
                                                    </div>
                                                    <!-- booker -->
                                                    <div>
                                                        <label for="bookerName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('content.manage-room.user') }}</label>
                                                        <input type="text" id="bookerName" name="bookerName"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="{{ __('content.manage-booking.user_name_booking') }}" value="{{ old('bookerName', request('bookerName')) }}">
                                                    </div>
                                                    <!-- phone number -->
                                                    <div>
                                                        <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('content.manage-room.phone_number') }}</label>
                                                        <input type="text" id="phoneNumber" name="phoneNumber"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="{{ __('content.manage-booking.phone_booking') }}" value="{{ old('phoneNumber', request('phoneNumber')) }}">
                                                    </div>
                                                    <!-- status -->
                                                    <div>
                                                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('content.manage-room.status') }}</label>
                                                        <select id="status" name="status"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="" {{ old('status') == '' ? 'selected' : '' }}>{{ __('content.manage-room.all') }}</option>
                                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ __('content.manage-booking.active') }}</option>
                                                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>{{ __('content.manage-booking.completed') }}</option>
                                                            <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>{{ __('content.manage-booking.canceled') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="flex justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="button"
                                                class="mr-2 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600"
                                                data-modal-hide="advancedSearchModal">
                                                {{ __('content.manage-room.close') }}
                                            </button>
                                            <button type="submit" form="advancedSearchForm"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                {{ __('content.manage-room.search') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.manage-booking.order_id') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.manage-booking.user') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.manage-booking.phone_number') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.manage-booking.typeRoom') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.manage-booking.time') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.manage-booking.quantity') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.manage-booking.price') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.manage-booking.status') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.userDevice.action') }}</th>
                            </tr>
                        </thead>

                        <tbody id="manage-booking">
                            @if ($bookings->isEmpty())
                                <tr class="text-gray-700 dark:text-gray-100">
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        {{ __('content.userDevice.empty') }}</td>
                                </tr>
                            @else
                                @include('admin.manage-room.table-booking')
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-between items-center p-0">{{ $bookings->links('admin.layouts.pagination') }}</div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        let debounceTimeout;
        $('#search').on('input', function() {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function() {
                $('#searchForm').submit(); 
            }, 500);
        });
    });
</script>
@endpush