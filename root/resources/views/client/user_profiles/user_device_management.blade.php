@extends('client.user_profiles.profiles')
@section('proFiles')
    <div class="w-full p-6 bg-white overflow-x-auto">
        <div class="flex justify-end mb-4">
            <a href="javascript:void(0)" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow"
                onclick="showLogoutModalALL()">
                {{ __('content.userDevice.logout_all') }}
            </a>
        </div>
        @if ($userDevice->isNotEmpty())
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-6 py-4 border-b text-left">{{ __('content.userDevice.user_id') }}</th>
                        <th class="px-6 py-4 border-b text-left">{{ __('content.userDevice.device_name') }}</th>
                        <th class="px-6 py-4 border-b text-left">{{ __('content.userDevice.device_type') }}</th>
                        <th class="px-6 py-4 border-b text-left">{{ __('content.userDevice.device_ip') }}</th>
                        <th class="px-6 py-4 border-b text-left">{{ __('content.userDevice.browser') }}</th>
                        <th class="px-6 py-4 border-b text-left">{{ __('content.userDevice.status') }}</th>
                        <th class="px-6 py-4 border-b text-left">{{ __('content.userDevice.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userDevice as $device)
                        <tr class="hover:bg-gray-50" id="device-row-{{ $device->id }}">
                            <td class="px-6 py-4 border-b text-gray-800">{{ $device->user->first_name }}
                                {{ $device->user->last_name }}</td>
                            <td class="px-6 py-4 border-b text-gray-800">{{ $device->device_name }}</td>
                            <td class="px-6 py-4 border-b text-gray-800 text-center">
                                @if ($device->device_type === DESKTOP)
                                    <img src="{{ asset('image/pc.png') }}" alt=''
                                        class='relative inline-block h-9 w-9 object-cover object-center' />
                                @elseif($device->device_type === TABLET)
                                    <img src="{{ asset('image/tablet.png') }}" alt=''
                                        class='relative inline-block h-9 w-9 object-cover object-center' />
                                @elseif($device->device_type === MOBILE)
                                    <img src="{{ asset('image/smartphone.png') }}" alt=''
                                        class='relative inline-block h-9 w-9 object-cover object-center' />
                                @else
                                    <img src="{{ asset('image/unknown.png') }}" alt=''
                                        class='relative inline-block h-9 w-9 object-cover object-center' />
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b text-gray-800">{{ $device->device_ip }}</td>
                            <td class="px-6 py-4 border-b text-gray-800">{{ $device->browser }}</td>
                            <td class="px-6 py-4 border-b text-center">
                                @if ($device->status === ACTIVE)
                                    <button type='button'
                                        class='text-center px-2 py-1 text-xs font-bold text-green-900 uppercase rounded-md bg-green-500/20'>
                                        {{ __('content.userDevice.active') }}
                                    </button>
                                @elseif($device->status === NOT_ACTIVE)
                                    <button type='button'
                                        class='text-center px-2 py-1 text-xs font-bold text-[#eda515] uppercase rounded-md bg-[#eda515]/20'>
                                        {{ __('content.userDevice.not_active') }}
                                    </button>
                                @else
                                    <button type='button'
                                        class='text-center px-2 py-1 text-xs font-bold text-red-900 uppercase rounded-md bg-red-500/20'>
                                        {{ __('content.userDevice.ban') }}
                                    </button>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b text-center">
                                @if (!($device->device_ip === $currentIp && $device->browser === $currentUserAgent))
                                    <button class="text-red-600 hover:text-red-800 mx-1"
                                        onclick="showLogoutModal('{{ $device->id }}')">{{ __('content.userDevice.logout_one') }}</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="w-full flex justify-between items-center p-2">{{ $userDevice->links('admin.layouts.pagination') }}
        @endif
    </div>


    <!-- Modal -->
    <div id="logoutModal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('content.userDevice.comfirm_logout') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('content.userDevice.comfirm_logout_one') }}</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeLogoutModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg">{{ __('content.userDevice.cancel') }}</button>
                <form id="logoutDeviceForm" action="" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg">{{ __('content.userDevice.yes') }}</button>
                </form>
            </div>
        </div>
    </div>

    <div id="logoutModalALL" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">{{ __('content.userDevice.comfirm_logout') }}</h3>
            <p>{{ __('content.userDevice.comfirm_logout_all') }}</p>
            <div class="flex justify-end mt-4">
                <button onclick="closeLogoutModalALL()"
                    class="bg-gray-300 text-black px-4 py-2 rounded-md mr-2">{{ __('content.userDevice.cancel') }}</button>
                <form id="logoutAllDeviceForm" action="" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-md">{{ __('content.userDevice.yes') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showLogoutModal(deviceId) {
            document.getElementById('logoutModal').classList.remove('hidden');
            document.getElementById('logoutDeviceForm').action = "{{ url('/devices/logout') }}/" + deviceId;
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }

        function showLogoutModalALL() {
            document.getElementById('logoutModalALL').classList.remove('hidden');
            document.getElementById('logoutAllDeviceForm').action = "{{ url('devices/logout-all') }}";
        }

        function closeLogoutModalALL() {
            document.getElementById('logoutModalALL').classList.add('hidden');
        }
    </script>

@endsection
