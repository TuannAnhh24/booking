@push('style')
<head>
    <style>
        .active {
            background-color: rgb(239 246 255);
        }

        .checkmark {
            opacity: 0;
        }

        .active .checkmark {
            opacity: 100;
        }
    </style>
    <title>Document</title>
</head>
@endpush

<header>
    <nav class="bg-blue-800">
        <div class="max-w-screen-lg flex flex-wrap items-center justify-between container mx-auto p-4">
            <a href="{{ route('home')}}" class="flex items-center space-x-3 rtl:space-x-reverse text-white">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ __('content.header.logo') }}</span>
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0">
                    <li>
                        <!-- Modal toggle -->
                        <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal" id="open-modal-btn"
                            class="text-white relative rounded hover:bg-white hover:bg-opacity-25 transition md:hover:text-white-800 md:p-3"
                            aria-current="page"><i class="bi bi-globe text-xl"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
    <!-- Modal content container -->
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-lg">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 rounded-t ">
                <h3 class="text-xl font-semibold text-gray-900">
                    {{ __('content.language.choicelang') }}
                </h3>
                <button type="button" id="close-modal-btn"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">{{ __('content.language.close') }}</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="md:px-5 px-4 pb-4 grid grid-cols-3 gap-4">
                <a href="{{ route('set-language', ['lang' => 'vi']) }}" class="flex items-center space-x-4 hover:bg-blue-100 hover:bg-opacity-25 md:p-3 group"
                    data-lang="vietnamese" data-country="vietnam">
                    <img src="{{ asset('image/vietnam.png')}}" alt="Vietnam" class="w-5 h-5 rounded-full">
                    <span class="text-sm text-gray-900">{{ __('content.language.vietnam') }}</span>
                    <i class="bi bi-check2 checkmark text-green-500 opacity-0 group-hover:opacity-100"></i>
                </a>
                <a href="{{ route('set-language', ['lang' => 'en']) }}" class="flex items-center space-x-4 hover:bg-blue-100 hover:bg-opacity-25 md:p-3 group"
                    data-lang="english" data-country="anh">
                    <img src="{{ asset('image/anh.png')}}" alt="English" class="w-5 h-5 rounded-full">
                    <span class="text-sm text-gray-900">{{ __('content.language.english') }}</span>
                    <i class="bi bi-check2 checkmark text-green-500 opacity-0 group-hover:opacity-100"></i>
                </a>
                <a href="{{ route('set-language', ['lang' => 'fr']) }}" class="flex items-center space-x-4 hover:bg-blue-100 hover:bg-opacity-25 md:p-3 group"
                    data-lang="french" data-country="phap">
                    <img src="{{ asset('image/phap.png')}}" alt="French" class="w-5 h-5 rounded-full">
                    <span class="text-sm text-gray-900">{{ __('content.language.français') }}</span>
                    <i class="bi bi-check2 checkmark text-green-500 opacity-0 group-hover:opacity-100"></i>
                </a>
                <!-- Thêm nhiều cờ khác nếu cần -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @include('client.login.js-header')
@endpush