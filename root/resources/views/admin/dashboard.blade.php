@extends('admin.layouts.master-layout')
@section('content')
    <!-- Content -->
    <div class="p-6">
        {{-- Tài khoản admin thường --}}
        @if (auth()->user()->role_id == 2)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="flex items-center mb-1">
                                {{-- <div class="text-2xl font-semibold">{{$availableRooms}}</div> --}}
                            </div>
                            <div class="text-sm font-medium text-gray-400">{{ __('content.dashboard.rooms_available') }}
                            </div>
                        </div>
                    </div>

                    <a href=""
                        class="text-[#f84525] font-medium text-sm hover:text-red-800">{{ __('content.dashboard.view') }}</a>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold">{{$bookingToDay}}</div>
                                {{-- <div
                                class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">
                                +30%</div> --}}
                            </div>
                            <div class="text-sm font-medium text-gray-400">{{ __('content.dashboard.bookings_for_today') }}
                            </div>
                        </div>
                    </div>
                    <a href=""
                        class="text-[#f84525] font-medium text-sm hover:text-red-800">{{ __('content.dashboard.view') }}</a>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1">100</div>
                            <div class="text-sm font-medium text-gray-400">{{ __('content.dashboard.monthly_revenue') }}
                            </div>
                        </div>
                    </div>
                    <a href=""
                        class="text-[#f84525] font-medium text-sm hover:text-red-800">{{ __('content.dashboard.view') }}</a>
                </div>
            </div>
            {{-- Tài khoản super admin và system admin --}}
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold">{{ $countDestination }}</div>
                            </div>
                            <div class="text-sm font-medium text-gray-400">{{ __('content.dashboard.registered_hotels') }}
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admin.destinations.index') }}"
                        class="text-[#f84525] font-medium text-sm hover:text-red-800">{{ __('content.dashboard.view') }}</a>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="flex items-center mb-1">
                                <div class="text-2xl font-semibold">{{ $recentDestinations }}</div>
                                {{-- <div
                                class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">
                                +30%</div> --}}
                            </div>
                            <div class="text-sm font-medium text-gray-400">
                                {{ __('content.dashboard.newly_registered_hotels') }}
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.destinations.index') }}"
                        class="text-[#f84525] font-medium text-sm hover:text-red-800">{{ __('content.dashboard.view') }}</a>
                </div>
                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                    <div class="flex justify-between mb-6">
                        <div>
                            <div class="text-2xl font-semibold mb-1">100</div>
                            <div class="text-sm font-medium text-gray-400">{{ __('content.dashboard.monthly_revenue') }}
                            </div>
                        </div>
                    </div>
                    <a href=""
                        class="text-[#f84525] font-medium text-sm hover:text-red-800">{{ __('content.dashboard.view') }}</a>
                </div>
            </div>
        @endif
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            {{-- Phân quyền người dùng --}}
            @if (auth()->user()->role_id == 2)
                <div
                    class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 w-full shadow-lg rounded">
                    <div class="rounded-t mb-0 px-0 border-0">
                        <div class="flex flex-wrap items-center px-4 py-2">
                            <div class="relative w-full max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-gray-900">
                                    {{ __('content.dashboard.users') }}</h3>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto">
                            <table class="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            {{ __('content.dashboard.name_user') }}</th>
                                        <th
                                            class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            {{ __('content.dashboard.email') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listUser as $user)
                                        <tr class="text-gray-700">
                                            <th
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                                {{ $user->first_name }} {{ $user->last_name }}</th>
                                            <td
                                                class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {{ $user->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div
                    class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 w-full shadow-lg rounded">
                    <div class="rounded-t mb-0 px-0 border-0">
                        <div class="flex flex-wrap items-center px-4 py-2">
                            <div class="relative w-full max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-base text-gray-900">
                                    {{ __('content.dashboard.users') }}</h3>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto">
                            <table class="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-4 bg-gray-100  align-middle border border-solid border-gray-200  py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            {{ __('content.dashboard.role') }}</th>
                                        <th
                                            class="px-4 bg-gray-100  align-middle border border-solid border-gray-200  py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            {{ __('content.dashboard.amount') }}</th>
                                        <th
                                            class="px-4 bg-gray-100  align-middle border border-solid border-gray-200  py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-gray-700 ">
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            {{ __('content.dashboard.super_admin') }}</th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ $rolesData['super_admin'] }}</td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <span
                                                    class="mr-2">{{ number_format($rolesData['percentages']['super_admin'], 2) }}%</span>
                                                <div class="relative w-full">
                                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                        <div style="width: {{ $rolesData['percentages']['super_admin'] }}%"
                                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-gray-700 ">
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            {{ __('content.dashboard.system_admin') }}</th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ $rolesData['system_admin'] }}</td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <span
                                                    class="mr-2">{{ number_format($rolesData['percentages']['system_admin'], 2) }}%</span>
                                                <div class="relative w-full">
                                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-blue-200">
                                                        <div style="width: {{ $rolesData['percentages']['system_admin'] }}%"
                                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-gray-700 ">
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            {{ __('content.dashboard.user_admin') }}</th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ $rolesData['user_admin'] }}</td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <span
                                                    class="mr-2">{{ number_format($rolesData['percentages']['user_admin'], 2) }}%</span>
                                                <div class="relative w-full">
                                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-pink-200">
                                                        <div style="width: {{ $rolesData['percentages']['user_admin'] }}%"
                                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-pink-500">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-gray-700 ">
                                        <th
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                            {{ __('content.dashboard.user') }}</th>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            {{ $rolesData['user'] }}</td>
                                        <td
                                            class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                            <div class="flex items-center">
                                                <span
                                                    class="mr-2">{{ number_format($rolesData['percentages']['user'], 2) }}%</span>
                                                <div class="relative w-full">
                                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-red-200">
                                                        <div style="width: {{ $rolesData['percentages']['user'] }}%"
                                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            {{-- Thông báo  --}}
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">{{ __('content.dashboard.notification') }}</div>
                </div>
                <div class="overflow-hidden">
                    <table class="w-full min-w-[540px]">
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">Lorem
                                            Ipsum</a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-400">02-02-2024</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-400">17.45</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">Lorem
                                            Ipsum</a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-400">02-02-2024</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-400">17.45</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Biểu Đồ --}}
        <div >
            @include('admin.analytics.index')
        </div>
    </div>
    <!-- End Content -->
@endsection
