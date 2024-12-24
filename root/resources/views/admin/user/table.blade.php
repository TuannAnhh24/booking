@foreach ($users as $user)
    <tr class="text-gray-700">
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            <img src="{{ !$user->avatar || empty($user->avatar) ? asset('image/avatar_default.png')
                : (str_starts_with($user->avatar, 'image/')  ? asset($user->avatar) : asset('storage/' . $user->avatar)) }}" alt='{{ $user->first_name }}'
                class='relative inline-block h-9 w-9 !rounded-full object-cover object-center' />
        </td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $user->first_name }} {{ $user->last_name }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $user->email }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $user->phone_number }}</td>
        @if ($user->status == '1')
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <button type='button'
                    class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20'>
                    <span class=''>{{ __('content.user.active') }}</span>
                </button>
            </td>
        @else
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <button type='button'
                    class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-red-900 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20'>
                    <span class=''>{{ __('content.user.ban') }}</span>
                </button>
            </td>
        @endif
        @if ($user->status == '1')
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4" onclick="openModal('lock', {{ $user->id }})">
                <i class="ri-lock-unlock-line text-xl"></i>
            </td>
        @else
            <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4" onclick="openModal('unlock', {{ $user->id }})">
                <i class="ri-lock-line text-xl"></i>
            </td>
        @endif
        <!-- Overlay -->
        <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>
        <!-- Modal -->
        <div id="popup-statusModal" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center items-center">
            <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only"></span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 id="modalMessage" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"></h3>
                    <button id="confirmButton" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        {{ __('content.update_status.yes') }}
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" onclick="closeModal()">{{ __('content.update_status.no') }}</button>
                </div>
            </div>
        </div>
    </tr>
@endforeach
@push('scripts')
<script>

    var lang = {
        confirm_lock: @json(__('content.update_status.confirm_lock')),
        confirm_unlock: @json(__('content.update_status.confirm_unlock'))
    };

    function openModal(action, userId) {
        const modal = document.getElementById('popup-statusModal');
        const overlay = document.getElementById('overlay');
        const modalMessage = document.getElementById('modalMessage');
        const confirmButton = document.getElementById('confirmButton');

        if (action === 'lock') {
            modalMessage.textContent = lang.confirm_lock;
            confirmButton.onclick = function() {
                updateUserStatus(userId, 'locked');
            };
        } else if (action === 'unlock') {
            modalMessage.textContent = lang.confirm_unlock;
            confirmButton.onclick = function() {
                updateUserStatus(userId, 'unlocked');
            };
        }

        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('popup-statusModal');
        const overlay = document.getElementById('overlay');
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    }

    function updateUserStatus(userId, status) {
        const url = `/admin/user/${userId}/status`;
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                closeModal();
                if (response.success) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(error) {
            }
        });
    }
</script>
@endpush

