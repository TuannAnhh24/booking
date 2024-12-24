<!--sidenav -->
<div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
        <h2 class="font-bold text-2xl">{{ __('content.header.logo') }} <span
                class="bg-[#f84525] text-white px-2 rounded-md">ADMIN</span></h2>
    </a>
    <ul class="mt-4">
        @if (Auth::check() && in_array(Auth::user()->role_id, [2, 3, 4]))
            <li class="mb-1 group">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">{{ __('content.sidebar.dashboard') }}</span>
                </a>
            </li>
        @endif
        @if (Auth::check() && Auth::user()->role_id === ROLES['user_admin'])
            <li class="mb-1 group">
                <a href="{{ route('admin.manage.manageRoom') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-store-3-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.manage') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.manage.manageBooking') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-list-ordered mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.order') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.destinations.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-pantone-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.destinations') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.variants.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-hammer-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.variant') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.rooms.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-home-heart-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.room') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.promotion.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-coupon-line mr-3 text-lg"></i>
                    <span class="text-sm">{{ __('content.promotion.promotion') }}</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="{{ route('admin.review.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-chat-poll-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.review.review') }}</span>
                </a>
            </li>
        @endif

        @if (Auth::check() && in_array(Auth::user()->role_id, [ROLES['system_admin'], ROLES['super_admin']]))
            <li class="mb-1 group">
                <a href="{{ route('admin.user.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-user mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.user') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.userDevice.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-device-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.user_device') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.categories.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-list-ul mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.category') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.characteristics.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-empathize-fill mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.characteristics') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.locations.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-map-2-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.locations') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.banners.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-slideshow-3-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.advertising_banners') }}</span>
                </a>
            </li>

            <li class="mb-1 group">
                <a href="{{ route('admin.convenients.index') }}"
                    class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='ri-magic-line mr-3 text-lg'></i>
                    <span class="text-sm">{{ __('content.sidebar.convenients') }}</span>
                </a>
            </li>
        @endif
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end sidenav -->
