<style>
    .form-control {
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 4px;
}

.form-control.error-border {
    border-color: red;
}

.tooltip-error {
    display: none;
    position: absolute;
    background-color: #f44336;
    color: white;
    padding: 8px;
    border-radius: 4px;
    font-size: 12px;
    margin-top: 4px;
    z-index: 10;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

.form-group {
    position: relative;
    margin-bottom: 20px;
}

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>

<form id="searchForm" action="{{ route('client.search') }}" method="GET">
    @csrf
    <div class="p-1 max-w-[1108px] mx-auto flex items-center justify-between w-full flex-wrap">
        <div class="w-full sm:w-[40%] mb-2 sm:mb-0">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " viewBox="0 0 640 512" fill="currentColor">
                        <path d="M144 192c0-26.5-21.5-48-48-48S48 165.5 48 192s21.5 48 48 48 48-21.5 48-48zm384-48H272c-8.8 0-16 7.2-16 16V352H64V80c0-26.5-21.5-48-48-48S-32 53.5-32 80v400c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V416H512v64c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V192c0-26.5-21.5-48-48-48z" />
                    </svg>
                </div>
                <input type="text" id="search" name="location"
                    class="focus:outline-none block w-full p-4 ps-10 text-sm text-black border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:placeholder-black dark:text-black"
                    placeholder="{{__('content.search.from')}}" value="{{ old('location', request('location')) }}" />
                    <span class="tooltip-error" id="error-location">{{__('content.search.validate')}}</span>
            </div>
        </div>
        <div class="w-[26%] h-full">
            <div class="focus-parent relative">
                <button type="button"
                    class="block w-full p-4 text-sm text-black border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:placeholder-black dark:text-black">
                    <div class="flex justify-between">
                        <div class=" inset-y-0 start-0 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 448 512">
                                <path
                                    d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                            </svg>
                        </div>
                        <span
                            class="block overflow-hidden text-ellipsis whitespace-nowrap w-[80px]">{{ __('content.search.check_in') }}</span>
                        -
                        <span
                            class="block overflow-hidden text-ellipsis whitespace-nowrap w-[80px]">{{ __('content.search.check_out') }}</span>
                    </div>
                </button>
                <!-- Datepicker -->

                <?php
                    $today = date('Y-m-d');
                    $tomorrow = date('Y-m-d', strtotime('+1 day'));
                ?>

                <div class="focus-child hidden">
                    <div
                        class="flex justify-between items-center z-10 top-[115%] p-4 gap-[24px] absolute  w-80 md:w-[40.4rem] bg-white border shadow-lg rounded-xl overflow-hidden">
                        <div class="flex flex-col w-full">
                            <label for="start-date" class="mb-3">{{ __('content.search.check_in') }}</label>
                            <input id="start-date" type="text" name="check_in" placeholder="{{__('content.search.check_in')}}" required
                                    class="w-full h-full border border-gray-300 rounded-lg" value="{{ old('check_in', request('check_in', $today)) }}">
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="end-date" class="mb-3">{{ __('content.search.check_out') }}</label>
                            <input id="end-date" type="text" name="check_out" placeholder="{{__('content.search.check_out')}}" required
                                    class="w-full h-full border border-gray-300 rounded-lg" value="{{ old('check_out', request('check_out', $tomorrow)) }}" >
                        </div>
                    </div>
                </div>
                <!-- End Datepicker -->
            </div>
        </div>

        <!-- Nút và menu điều chỉnh số lượng -->
        @php
            $defaultAdults = old('people_old', request('people_old', 2));
            $defaultRooms = old('rooms', request('rooms', 1));
        @endphp

        <div class="w-[26%] relative">
            <button type="button" id="displayButton"
                class="flex items-center justify-between w-full p-4 pl-4 text-sm text-black border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:placeholder-black dark:text-black">
                <div class="flex items-center space-x-2">
                    <!-- Icon cố định -->
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-8" viewBox="0 0 448 512"
                            fill="currentColor">
                            <path
                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm112 32h-16a174.6 174.6 0 0 1-192 0h-16A112 112 0 0 0 0 400v16a96 96 0 0 0 96 96h256a96 96 0 0 0 96-96v-16a112 112 0 0 0-112-112z" />
                        </svg>
                    </div>
                    <span id="roomPeopleText">
                        {{ $defaultAdults }} {{ __('content.search.quantity_people_old') }} · {{ $defaultRooms }}
                        {{ __('content.search.quantity_room') }}
                    </span>
                </div>
            </button>

            <div id="roomSelector"
                class="hidden absolute bg-white border shadow-xl rounded-lg p-4 w-full min-w-[350px]">
                <div class="flex justify-between items-center mb-2">
                    <span>{{ __('content.search.quantity_people_old') }}</span>
                    <div class="border border-[#858585] rounded-lg">
                        <button type="button" onclick="decrement('adultsCount')" class="px-2 outline-none">
                            <i class="ri-subtract-line text-md text-[#006ce3]"></i>
                        </button>
                        <input type="text" id="adultsCount" name="people_old" value="{{ $defaultAdults }}" readonly
                            class="w-8 mx-[12px] text-center border-none">
                        <button type="button" onclick="increment('adultsCount')" class="px-2 outline-none">
                            <i class="ri-add-line text-md text-[#006ce3]"></i>
                        </button>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <span>{{ __('content.search.quantity_room') }}</span>
                    <div class="border border-[#858585] rounded-lg">
                        <button type="button" onclick="decrement('roomsCount')" class="px-2 outline-none">
                            <i class="ri-subtract-line text-md text-[#006ce3]"></i>
                        </button>
                        <input type="text" id="roomsCount" name="rooms" value="{{ $defaultRooms }}"
                            class="w-8 mx-[12px] text-center border-none">
                        <button type="button" onclick="increment('roomsCount')" class="px-2 outline-none">
                            <i class="ri-add-line text-md text-[#006ce3]"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-[6%]">
            <button type="submit" id="submitButton"
                class="bg-[#006ce3] p-[14px] w-full rounded-lg text-xl text-white font-medium">Tìm</button>
        </div>
    </div>
</form>

<script>
    const btnParent = document.querySelector(".focus-parent");
    const btnChild = document.querySelector(".focus-child");
    const btnCancel = document.querySelector(".btn-cancel");

    btnParent.addEventListener("click", (e) => {
        e.stopPropagation();
        e.preventDefault();
        btnChild.classList.toggle("hidden");
    });

    btnChild.addEventListener("click", (e) => {
        e.stopPropagation();
    });

    btnCancel.addEventListener("click", function(event) {
        event.stopPropagation(); 
        hide();
    });
    document.addEventListener("click", () => {
        if (!btnChild.classList.contains("hidden")) {
            btnChild.classList.add("hidden");
        }
    });
</script>
<script>
    function app() {
        return {
            chartData: [10, 50, 20, 40, 25, 35, 60, 65, 15, 10, 50, 20, 40, 25, 35, 60, 65, 15, 25, 35, 60, 65, 15, 50,
                20, 40, 25, 35, 60, 50, 20, 40, 25, 35, 60, 40, 25, 35, 60, 50, 20, 40, 25, 35, 60,
            ],
            tooltipContent: '',
            tooltipOpen: false,
            tooltipX: 0,
            tooltipY: 0,
            showTooltip(e) {
                console.log(e);
                this.tooltipContent = e.target.textContent
                this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
                this.tooltipY = e.target.clientHeight + e.target.clientWidth;
            },
            hideTooltip(e) {
                this.tooltipContent = '';
                this.tooltipOpen = false;
                this.tooltipX = 0;
                this.tooltipY = 0;
            }
        }
    }
</script>
<script>
    flatpickr("#start-date", {
        plugins: [new rangePlugin({
            input: "#end-date"
        })],
        dateFormat: "Y-m-d", 
        minDate: "today", 
        locale: {
            firstDayOfWeek: 1
        }
    });
</script>
<script>
    document.getElementById('displayButton').addEventListener('click', function() {
        const roomSelector = document.getElementById('roomSelector');
        roomSelector.classList.toggle('hidden');
    });

    function formatDateToInput(date) {
        const d = new Date(date);
        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const day = String(d.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`; 
    }

    var messages = {
        people: @json(__('content.search.quantity_people_old')),
        rooms: @json(__('content.search.quantity_room')),
    };
    function updateRoomPeopleText() {
    const adults = document.getElementById('adultsCount').value || 2;
    const rooms = document.getElementById('roomsCount').value || 1;
    const textElement = document.getElementById('roomPeopleText');
    textElement.textContent = `${adults} ${messages.people} · ${rooms} ${messages.rooms}`;
    }

    function increment(id) {
        const input = document.getElementById(id);
        input.value = parseInt(input.value) + 1;
        updateRoomPeopleText();
    }

    function decrement(id) {
        const input = document.getElementById(id);
        if (parseInt(input.value) > 0) {
            input.value = parseInt(input.value) - 1;
            updateRoomPeopleText();
        }
    }
    window.onload = function () {
        updateRoomPeopleText();
    };

    document.getElementById('searchForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const inputs = [
        { id: 'search', errorId: 'error-location', message: @json(__('content.search.validate')) },
    ];

    let hasError = false;

    inputs.forEach(input => {
        const field = document.getElementById(input.id);
        const tooltip = document.getElementById(input.errorId);

        if (!field.value.trim()) {
            tooltip.style.display = 'block';
            field.classList.add('error-border');
            hasError = true;

            field.addEventListener('input', () => {
                tooltip.style.display = 'none';
                field.classList.remove('error-border');
            });
        } else {
            tooltip.style.display = 'none';
            field.classList.remove('error-border');
        }
    });

    if (!hasError) {
        this.submit(); 
    }
    });
</script>
