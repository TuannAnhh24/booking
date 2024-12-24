@foreach ($userDevices as $userDevice)
    <tr class="text-gray-700">
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            {{ $userDevice->user->first_name}} {{ $userDevice->user->last_name}}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">                                    
            {{ $userDevice->device_name }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            @if($userDevice->device_type === DESKTOP)
                <img src="{{ asset('image/pc.png')}}" alt='' class='relative inline-block h-9 w-9 object-cover object-center' />
            @elseif($userDevice->device_type === TABLET)
                <img src="{{ asset('image/tablet.png')}}" alt='' class='relative inline-block h-9 w-9 object-cover object-center' />
            @elseif($userDevice->device_type === MOBILE)
                <img src="{{ asset('image/smartphone.png')}}" alt='' class='relative inline-block h-9 w-9 object-cover object-center' />
            @else
                <img src="{{ asset('image/unknown.png')}}" alt='' class='relative inline-block h-9 w-9 object-cover object-center' />
            @endif
        </td>                                  
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">                                     
            {{ $userDevice->device_ip }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $userDevice->browser }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            @if($userDevice->status === ACTIVE)
                <button type='button' class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20'>
                    <span class=''>{{ __('content.userDevice.active') }}</span>
                </button>
            @elseif($userDevice->status === NOT_ACTIVE)
                <button type='button' class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-[#eda515] uppercase rounded-md select-none whitespace-nowrap bg-[#eda515]/20'>
                    <span class=''>{{ __('content.userDevice.not_active') }}</span>
                </button>
            @else        
                <button type='button' class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-red-900 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20'>
                    <span class=''>{{ __('content.userDevice.ban') }}</span>
                </button>
            @endif
        </td>
    </tr>
@endforeach