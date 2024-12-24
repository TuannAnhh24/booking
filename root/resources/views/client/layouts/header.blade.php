<style>
    .hidden {
        display: none;
    }

    .show {
        display: block;
    }

    #dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        width: 12rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        z-index: 10;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        opacity: 0;
        visibility: hidden;
    }

    #dropdown-menu.show {
        opacity: 1;
        visibility: visible;
    }

    #notification-dropdown {
        position: absolute;
        right: 0;
        top: 100%;
        width: 12rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        z-index: 10;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        opacity: 0;
        visibility: hidden;
    }

    #notification-dropdown.show {
        opacity: 1;
        visibility: visible;
    }
</style>
<div>
    <header class="bg-[#003b95]">
        <div class="w-[1024px] mx-auto max-w-full">
            <div class="h-full relative">
                <div class="flex justify-between py-3">
                    <h2 class="text-3xl font-bold text-white leading-none grow">
                        <a href="{{ route('home') }}">{{ __('content.header.logo') }}</a>
                    </h2>
                    <div class="flex gap-2.5 items-center justify-end">
                        <!-- modal tiền tệ -->
                        <!-- <MoneyMd /> -->
                        <div class="py-2 px-3 cursor-pointer" id="open-modal-btn">
                            <!-- modal lang-->
                            <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal"
                                class="text-white relative rounded hover:bg-white hover:bg-opacity-25 transition md:hover:text-white-800 md:p-3"
                                aria-current="page"><i class="bi bi-globe text-xl"></i>
                            </a>
                        </div>

                        <div id="default-modal" tabindex="-1" aria-hidden="true"
                            class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow-lg z-20">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            {{ __('content.language.choicelang') }}
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                            id="close-modal-btn">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">{{ __('content.language.close') }}</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="md:px-5 px-4 pb-4 grid grid-cols-3 gap-4">
                                        <a href="{{ route('set-language', ['lang' => 'vi']) }}"
                                            class="flex items-center space-x-4 hover:bg-blue-100 hover:bg-opacity-25 md:p-3 group"
                                            data-lang="vietnamese" data-country="vietnam">
                                            <img src="{{ asset('image/vietnam.png') }}" alt="Vietnam"
                                                class="w-5 h-5 rounded-full">
                                            <span
                                                class="text-sm text-gray-900 dark:text-white">{{ __('content.language.vietnam') }}</span>
                                            <i
                                                class="bi bi-check2 checkmark text-green-500 opacity-0 group-hover:opacity-100"></i>
                                        </a>
                                        <a href="{{ route('set-language', ['lang' => 'en']) }}"
                                            class="flex items-center space-x-4 hover:bg-blue-100 hover:bg-opacity-25 md:p-3 group"
                                            data-lang="english" data-country="anh">
                                            <img src="{{ asset('image/anh.png') }}" alt="English"
                                                class="w-5 h-5 rounded-full">
                                            <span
                                                class="text-sm text-gray-900 dark:text-white">{{ __('content.language.english') }}</span>
                                            <i
                                                class="bi bi-check2 checkmark text-green-500 opacity-0 group-hover:opacity-100"></i>
                                        </a>
                                        <a href="{{ route('set-language', ['lang' => 'fr']) }}"
                                            class="flex items-center space-x-4 hover:bg-blue-100 hover:bg-opacity-25 md:p-3 group"
                                            data-lang="french" data-country="phap">
                                            <img src="{{ asset('image/phap.png') }}" alt="French"
                                                class="w-5 h-5 rounded-full">
                                            <span
                                                class="text-sm text-gray-900 dark:text-white">{{ __('content.language.français') }}</span>
                                            <i
                                                class="bi bi-check2 checkmark text-green-500 opacity-0 group-hover:opacity-100"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="leading-none text-base font-medium text-white py-2 px-3 hover:bg-white hover:bg-opacity-25 cursor-pointer rounded">
                            @if (Auth::check() && in_array(Auth::user()->role_id, [2, 3, 4]))
                                <a href="{{ route('admin.dashboard') }}">{{ __('content.header.manage') }}</a>
                            @else
                                <a href="{{ route('users.property.page') }}">{{ __('content.header.update_role') }}</a>
                            @endif
                        </div>

                        @if (auth()->check())
                                            <div class="relative">
                                                <div class="flex items-center cursor-pointer hover:bg-white hover:bg-opacity-25 rounded "
                                                    id="user-profile" onclick="toggleDropdown()">
                                                    <img src="{{ !Auth::user()->avatar || empty(Auth::user()->avatar) ? asset('image/avatar_default.png')
                            : (str_starts_with(Auth::user()->avatar, 'image/') ? asset(Auth::user()->avatar)
                                : asset('storage/' . Auth::user()->avatar)) }}"
                                                        class="h-8 w-8 rounded-full border-2 border-yellow-400 mr-2 {{ !Auth::user()->avatar || empty(Auth::user()->avatar) ? 'bg-white' : '' }}"
                                                        alt="Avatar" />
                                                    <div class="flex flex-col">
                                                        <span class="text-white">{{ Auth::user()->first_name }}
                                                            {{ Auth::user()->last_name }}</span>
                                                        <span class="text-white text-xs">{{ __('content.header.role') }}
                                                            {{ Auth::user()->role_id }}</span>
                                                    </div>
                                                </div>
                                                <!-- Dropdown Menu -->
                                                <div id="dropdown-menu"
                                                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                                                    <ul class="py-1">
                                                        <li>
                                                            <a href="{{ route('users.showProfile') }}"
                                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                <i class="ri-user-line"></i> {{ __('content.header.manage_user') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route(config('chatify.routes.prefix')) }}"
                                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                <i class="ri-message-2-line"></i> {{ __('content.header.message') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('users.bookingHistory') }}"
                                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                <i class="ri-briefcase-line"></i> {{ __('content.header.history') }}
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('logout') }}"
                                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i
                                                                    class="ri-logout-circle-line"></i>
                                                                {{ __('content.header.logout') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                        @else
                            <a class="py-2 px-4 bg-white font-medium text-[#006ce4] text-sm rounded"
                                href="{{ route('register') }}">
                                {{ __('content.header.register') }}
                            </a>
                            <a class="py-2 px-4 bg-white font-medium text-[#006ce4] text-sm rounded"
                                href="{{ route('login') }}">
                                {{ __('content.header.login') }}
                            </a>
                        @endif

                    </div>
                </div>
                {{-- Nav --}}
                {{-- <div>
                    <nav class="flex justify-start py-4 text-white">
                        <a href="#"
                            class="flex items-center space-x-2 py-[11px] px-[16px] rounded-3xl text-sm border hover:bg-[#1a4f9f]">
                            <img src="{{ asset('image/bed.png') }}"
                                class="h-5 w-5 filter brightness-0 invert font-semibold" alt="" />
                            <span>{{ __('content.header.save_home') }}</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-2 py-[11px] px-[16px] rounded-3xl text-sm hover:bg-[#1a4f9f]">
                            <i class="fa-solid fa-plane"></i>
                            <span>Chuyến bay</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-2 py-[11px] px-[16px] rounded-3xl text-sm hover:bg-[#1a4f9f]">
                            <i class="fa-solid fa-earth-americas"></i>
                            <span>Chuyến bay + Khách sạn</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-2 py-[11px] px-[16px] rounded-3xl text-sm hover:bg-[#1a4f9f]">
                            <i class="fa-solid fa-car"></i>
                            <span>Thuê xe</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-2 py-[11px] px-[16px] rounded-3xl text-sm hover:bg-[#1a4f9f]">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <span>Địa điểm tham quan</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-2 py-[11px] px-[16px] rounded-3xl text-sm hover:bg-[#1a4f9f]">
                            <i class="fa-solid fa-taxi"></i>
                            <span>Taxi sân bay</span>
                        </a>
                    </nav>
                </div> --}}
            </div>
        </div>
    </header>
</div>

<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById('dropdown-menu');
        dropdownMenu.classList.toggle('show');
    }
    document.addEventListener('DOMContentLoaded', function () {
        const openModalBtn = document.getElementById('open-modal-btn');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const modal = document.getElementById('default-modal');

        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });

        const selectedLang = localStorage.getItem('selectedLang');
        if (selectedLang) {
            document.querySelectorAll('[data-lang]').forEach(item => {
                if (item.getAttribute('data-lang') === selectedLang) {
                    item.classList.add('active');
                    item.querySelector('.checkmark').classList.add('opacity-100');
                }
            });
        }

        document.querySelectorAll('[data-lang]').forEach(item => {
            item.addEventListener('click', (event) => {
                const lang = item.getAttribute('data-lang');
                localStorage.setItem('selectedLang', lang);
                document.querySelectorAll('[data-lang]').forEach(link => {
                    link.classList.remove('active');
                    link.querySelector('.checkmark').classList.remove('opacity-100');
                });
                item.classList.add('active');
                item.querySelector('.checkmark').classList.add('opacity-100');
            });
        });
    });
</script>