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
                                {{ __('content.destination.destination_list') }}
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
                                    <input
                                        class='peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50'
                                        placeholder='' />
                                    <label
                                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        {{ __('content.destination.search') }}
                                    </label>
                                </div>
                            </div>

                            <div class="dropdown">
                                <button type="button"
                                    class="dropdown-toggle select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"><i
                                        class="ri-more-2-fill"></i></button>
                                <ul
                                    class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                    <li>
                                        <a href="{{ route('admin.destinations.trash') }}"
                                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">{{__('content.location.trash')}}</a>
                                    </li>
                                </ul>
                                </button>
                            </div>



                            <button
                                class='flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                type='button' id='open_modal_button'>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                                    aria-hidden='true' strokeWidth='2' class='w-4 h-4'>
                                    <path
                                        d='M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z'>
                                    </path>
                                </svg>
                                {{ __('content.destination.add') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    ID</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.destination.name_destination') }}</th>
                                {{-- <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.destination.area_destination') }}</th> --}}
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.destination.detailed_address') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.destination.thumbnail') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.destination.description') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.destination.views') }}</th>
                                <th
                                    class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.destination.action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($destinations as $destination)
                                <tr class="text-gray-700 dark:text-gray-100">
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $destination->id }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $destination->name }}</td>
                                    {{-- <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @foreach ($destination->locations as $location)
                                            {{ $location->name }}, {{ $location->pivot->address }}<br>
                                        @endforeach


                                    </td> --}}
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $destination->detailed_address }}</td>
                                    <!-- Hiển thị ảnh đại diện cho từng destination -->
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        @if ($destination->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $destination->images->first()->image) }}"
                                                alt="Product Image" class="w-auto h-8 mr-3 cursor-pointer"
                                                onclick="openDestinationImageModal({{ $destination->id }})" />
                                        @else
                                            No image!
                                        @endif
                                    </td>
                                    <!-- Modal hiển thị tất cả ảnh cho destination -->
                                    <div id="destinationImageModal-{{ $destination->id }}"
                                        class="destination-image-modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                        <div
                                            class="bg-white rounded-lg p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-screen overflow-auto relative">
                                            <button class="absolute top-2 right-2 text-red-500 font-bold text-2xl"
                                                onclick="closeDestinationImageModal({{ $destination->id }})">&times;</button>
                                            <h2 class="text-lg font-semibold mb-4">Tất cả ảnh</h2>
                                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                                @foreach ($destination->images as $image)
                                                    <img src="{{ asset('storage/' . $image->image) }}"
                                                        alt="Image {{ $loop->index + 1 }}"
                                                        class="w-full h-32 object-cover rounded border shadow-sm" />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs p-4 max-w-[300px] truncate">
                                        {{ $destination->description }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $destination->views }}</td>

                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">

                                        <button
                                            class='edit-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            title='Edit' type='button' data-id="{{ $destination->id }}">
                                            <i class="ri-pencil-line text-xl"></i>
                                        </button>

                                        <button
                                            class='delete-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-red-400 transition-all hover:bg-red-500/10 active:bg-red-500/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type="button" title='Delete' data-id="{{ $destination->id }}">
                                            <i class="ri-delete-bin-line text-xl"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-full flex justify-between items-center p-0">
                        {{ $destinations->links('admin.layouts.pagination') }}
                    </div>
                </div>
                @include('admin.destinations.add')
                @isset($destination)
                    @include('admin.destinations.edit')
                    @include('admin.destinations.delete')
                @endisset
                @isset($districtCode)
                    @include('admin.destinations.edit')
                    @include('admin.destinations.delete')
                @endisset

                @isset($wardCode)
                    @include('admin.destinations.edit')
                    @include('admin.destinations.delete')
                @endisset



            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal_add_product');
            const openModalButton = document.getElementById('open_modal_button');
            const form = document.getElementById('form-add-destination');
            const addAnotherDestinationButton = document.getElementById('add-another-destination');
            const submitAllDestinationsButton = document.getElementById(
                'submit-all-destinations'); // Nút để gửi toàn bộ địa điểm
            const destinationList = document.getElementById('destination-list');
            let destinations = [];

            openModalButton.addEventListener('click', function() {
                modal.showModal();
            });
            // Khởi tạo Select2 cho từng dropdown với placeholder riêng
            ['location_id', 'district_id', 'ward_id'].forEach(function(id) {
                const placeholderMap = {
                    'location_id': 'Chọn tỉnh',
                    'district_id': 'Chọn huyện',
                    'ward_id': 'Chọn xã'
                };

                $('#' + id).select2({
                    placeholder: placeholderMap[id], // Đặt placeholder tương ứng
                    dropdownParent: modal,
                    allowClear: true,
                    width: '100%'
                });
            });
            // Khi chọn tỉnh, load danh sách huyện
            $('#location_id').on('change', function() {
                const locationName = $(this).val();
                if (locationName) {
                    // Đổi đường dẫn để lấy dữ liệu từ provinces.json trong thư mục /api
                    fetch('/api/provinces.json')
                        .then(response => response.json())
                        .then(responseData => {
                            const province = responseData.find(province => province.name ===
                                locationName);
                            if (province) {
                                const provinceId = province.code;

                                // Đổi đường dẫn để lấy dữ liệu từ districts.json trong thư mục /api
                                fetch('/api/districts.json')
                                    .then(response => response.json())
                                    .then(responseData => {
                                        const districts = responseData.filter(district => district
                                            .province_code === provinceId);
                                        const $districtSelect = $('#district_id');
                                        $districtSelect.empty().append(
                                            '<option value="">Chọn huyện</option>'
                                        ); // Clear and reset

                                        if (districts && districts.length > 0) {
                                            districts.forEach(district => {
                                                const option = new Option(district.name,
                                                    district.code, false, false);
                                                $districtSelect.append(option);
                                            });
                                            $districtSelect.trigger('change'); // Refresh Select2
                                        } else {
                                            console.error('No districts found in the data:',
                                                responseData);
                                        }
                                    })
                                    .catch(error => console.error('Error fetching districts:', error));
                            } else {
                                console.error('Province not found in API');
                            }
                        })
                        .catch(error => console.error('Error fetching provinces from API:', error));
                }
            });

            // Khi chọn huyện, load danh sách xã và lưu mã huyện vào input ẩn
            $('#district_id').on('change', function() {
                const districtCode = $(this).val();
                $('#district_code').val(districtCode); // Gán mã huyện vào input ẩn

                if (districtCode) {
                    // Đổi đường dẫn để lấy dữ liệu từ wards.json trong thư mục /api
                    fetch('/api/wards.json')
                        .then(response => response.json())
                        .then(responseData => {
                            // Kiểm tra xem dữ liệu wards có tồn tại và không rỗng
                            if (responseData && responseData.length > 0) {
                                const wards = responseData.filter(ward => ward.district_code ==
                                    districtCode);
                                const $wardSelect = $('#ward_id');
                                $wardSelect.empty().append(
                                    '<option value="">Chọn xã</option>'); // Clear and reset

                                if (wards.length > 0) {
                                    wards.forEach(ward => {
                                        const option = new Option(ward.name, ward.code, false,
                                            false);
                                        $wardSelect.append(option);
                                    });
                                    $wardSelect.trigger('change'); // Refresh Select2
                                } else {
                                    console.error('No wards found in the data for district_code:',
                                        districtCode);
                                }
                            } else {
                                console.error('Wards data is empty or undefined:', responseData);
                            }
                        })
                        .catch(error => console.error('Error fetching wards:', error));
                }
            });


            // Khi chọn xã, lưu mã xã vào input ẩn
            $('#ward_id').on('change', function() {
                const wardCode = $(this).val();
                $('#ward_code').val(wardCode); // Gán mã xã vào input ẩn
            });


            addAnotherDestinationButton.addEventListener('click', function(event) {
                event.preventDefault();

                // Xóa các thông báo lỗi cũ
                document.querySelectorAll('.message, .category-error, .convenient-error').forEach(function(
                    element) {
                    element.remove();
                });

                // Khai báo districtSelect, wardSelect, và provinceSelect trước khi sử dụng
                const districtSelect = document.getElementById('district_id');
                const wardSelect = document.getElementById('ward_id');
                const provinceSelect = document.getElementById('location_id');

                // Lấy danh sách danh mục đã chọn và lưu cả ID và tên
                const selectedCategories = Array.from(document.querySelectorAll(
                    'input[name="categoriesAdd[]"]:checked')).map(checkbox => ({
                    id: checkbox.value,
                    name: checkbox.nextElementSibling.innerText.trim()
                }));

                // Lấy danh sách tiện nghi đã chọn và lưu cả ID và tên
                const selectedConvenients = Array.from(document.querySelectorAll(
                    'input[name="convenientsAdd[]"]:checked')).map(checkbox => ({
                    id: checkbox.value,
                    name: checkbox.nextElementSibling.innerText.trim()
                }));

                // Lấy giá trị của Tỉnh, Huyện, Xã (nếu chọn mặc định thì gán giá trị rỗng)
                const locationValue = provinceSelect.value.trim();
                const districtValue = districtSelect.value !== "" && districtSelect.selectedIndex > 0 ?
                    districtSelect.options[districtSelect.selectedIndex].text : "";
                const wardValue = wardSelect.value !== "" && wardSelect.selectedIndex > 0 ? wardSelect
                    .options[wardSelect.selectedIndex].text : "";

                const newDestination = {
                    location: locationValue,
                    district: districtValue, // Chỉ lấy tên huyện nếu không phải là giá trị mặc định
                    ward: wardValue, // Chỉ lấy tên xã nếu không phải là giá trị mặc định
                    district_code: document.getElementById('district_code').value.trim(),
                    ward_code: document.getElementById('ward_code').value.trim(),
                    name: document.getElementById('name').value.trim(),
                    detailed_address: document.getElementById('detailed_address').value.trim(),
                    description: document.getElementById('description').value.trim(),
                    images: Array.from(document.getElementById('imagesAdd').files),
                    categories: selectedCategories,
                    convenients: selectedConvenients // Thêm tiện nghi vào đối tượng
                };

                let hasError = false;

                // Kiểm tra nếu có trường nào rỗng cho các trường bắt buộc và hiển thị lỗi
                if (!newDestination.location) {
                    showError('location_id', 'Vui lòng chọn tỉnh.');
                    hasError = true;
                }
                if (!newDestination.district) {
                    showError('district_id', 'Vui lòng chọn huyện.');
                    hasError = true;
                }
                if (!newDestination.ward) {
                    showError('ward_id', 'Vui lòng chọn xã.');
                    hasError = true;
                }
                if (!newDestination.name) {
                    showError('name', 'Vui lòng nhập tên địa điểm.');
                    hasError = true;
                }
                if (!newDestination.detailed_address) {
                    showError('detailed_address', 'Vui lòng nhập địa chỉ chi tiết.');
                    hasError = true;
                }
                if (!newDestination.categories.length) {
                    showError('categoriesAdd', 'Vui lòng chọn ít nhất một danh mục.');
                    hasError = true;
                }
                if (!newDestination.convenients.length) {
                    showError('convenientsAdd', 'Vui lòng chọn ít nhất một tiện nghi.');
                    hasError = true;
                }

                if (hasError) return;

                const isAlreadyInDestinations = destinations.some(destination =>
                    destination.location === newDestination.location &&
                    destination.district === newDestination.district &&
                    destination.ward === newDestination.ward &&
                    destination.name === newDestination.name
                );

                if (isAlreadyInDestinations) {
                    showError('location_id', 'Địa điểm này đã được thêm.');
                    return;
                }

                const destinationCopy = {
                    ...newDestination,
                    images: [...newDestination.images],
                };

                destinations.push(destinationCopy);
                createFormForDestination(destinationCopy, destinations.length - 1);

                // Reset các trường tỉnh, huyện, xã sau khi thêm địa chỉ
                provinceSelect.value = ''; // Reset về tùy chọn trống hoặc giá trị rỗng cho tỉnh
                $('#location_id').trigger('change'); // Làm mới Select2 cho trường tỉnh

                districtSelect.innerHTML = '<option value="">Chọn huyện</option>'; // Reset danh sách huyện
                $('#district_id').trigger('change'); // Làm mới Select2 cho trường huyện

                wardSelect.innerHTML = '<option value="">Chọn xã</option>'; // Reset danh sách xã
                $('#ward_id').trigger('change'); // Làm mới Select2 cho trường xã

                // Reset các checkbox danh mục và tiện nghi
                document.querySelectorAll('input[name="categoriesAdd[]"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                document.querySelectorAll('input[name="convenientsAdd[]"]').forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Reset các input file và phần xem trước ảnh
                selectedFiles = [];
                form.reset();
                document.getElementById('previewAdd').innerHTML = '';
            });


            // Hàm showError với điều chỉnh để tìm phần tử container của categories
            function showError(inputId, message) {
                // Hàm xử lý chung cho các trường hợp categoriesAdd và convenientsAdd
                const handleError = function(inputName, errorClass) {
                    const inputElement = document.querySelector('input[name="' + inputName + '[]"]');
                    if (inputElement) {
                        const container = inputElement.closest('.sm\\:col-span-2');
                        if (container) {
                            let errorDiv = container.querySelector('.' + errorClass);
                            if (!errorDiv) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = errorClass + ' text-red-700 mt-2'; // Tạo div nếu chưa có
                                container.appendChild(errorDiv); // Thêm div vào vùng chứa
                            }
                            errorDiv.textContent = message; // Gán thông báo lỗi
                        }
                    }
                };

                // Xử lý các trường hợp inputId là categoriesAdd hoặc convenientsAdd
                if (inputId === 'categoriesAdd') {
                    handleError('categoriesAdd', 'category-error');
                    return;
                }

                if (inputId === 'convenientsAdd') {
                    handleError('convenientsAdd', 'convenient-error');
                    return;
                }

                // Xử lý lỗi cho các input khác
                const inputElement = document.getElementById(inputId);
                if (inputElement) {
                    let errorMessage = inputElement.nextElementSibling;
                    if (!errorMessage || !errorMessage.classList.contains('message')) {
                        errorMessage = document.createElement('div');
                        errorMessage.className = 'message text-red-700'; // Thêm class cho thông báo lỗi
                        inputElement.insertAdjacentElement('afterend', errorMessage); // Thêm sau input
                    }
                    errorMessage.textContent = message; // Gán thông báo lỗi
                }
            }

            // Hàm tạo form cho từng địa điểm
            // Cập nhật hàm createFormForDestination để hiển thị tên các tiện nghi đã chọn
            function createFormForDestination(destination, index) {
                const destinationFormDiv = document.createElement('div');
                destinationFormDiv.classList.add('bg-gray-100', 'p-4', 'rounded-lg', 'mt-4');

                const categoryNames = destination.categories.map(category => category.name).join(', ');
                const convenientNames = destination.convenients.map(convenient => convenient.name).join(', ');

                destinationFormDiv.innerHTML = `
                <h3 class="text-lg font-bold">Địa điểm ${index + 1}</h3>
                <form class="destination-form" id="destination-form-${index}">
                    <label><strong>Tỉnh:</strong> ${destination.location}</label><br>
                    <label><strong>Huyện:</strong> ${destination.district}</label><br>
                    <label><strong>Xã:</strong> ${destination.ward}</label><br>
                    <label><strong>Tên địa điểm:</strong> ${destination.name}</label><br>
                    <label><strong>Địa chỉ chi tiết:</strong> ${destination.detailed_address}</label><br>
                    <label><strong>Mô tả:</strong> ${destination.description}</label><br>
                    <label><strong>Danh mục:</strong> ${categoryNames}</label><br>
                    <label><strong>Tiện nghi:</strong> ${convenientNames}</label><br>
                    <label><strong>Ảnh:</strong></label>
                    <div class="flex flex-wrap" id="image-preview-${index}"></div>
                </form>`;
                destinationList.appendChild(destinationFormDiv);

                if (destination.images.length > 0) {
                    displayImages(destination.images, `image-preview-${index}`);
                } else {
                    document.getElementById(`image-preview-${index}`).innerHTML = '<p>Không có ảnh</p>';
                }
            }


            // Hàm hiển thị ảnh
            function displayImages(images, previewElementId) {
                const previewElement = document.getElementById(previewElementId);
                previewElement.innerHTML = ''; // Xóa nội dung cũ

                images.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md',
                            'shadow-sm', 'border', 'border-gray-300', 'mr-2', 'mb-2');
                        previewElement.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file); // Đọc file dưới dạng URL base64
                });
            }
            let isSubmitting = false; // Cờ trạng thái kiểm tra việc gửi form

            submitAllDestinationsButton.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của nút submit

                // Kiểm tra nếu đang gửi thì không thực hiện gì cả
                if (isSubmitting) return;

                // Đặt cờ trạng thái là đang xử lý
                isSubmitting = true;
                submitAllDestinationsButton.disabled = true; // Vô hiệu hóa nút để ngăn nhấn nhiều lần
                submitAllDestinationsButton.textContent = 'Đang gửi...'; // Hiển thị trạng thái gửi
                addAnotherDestinationButton.style.display = 'none';

                // Xóa các thông báo lỗi cũ
                document.querySelectorAll('.message').forEach(function(element) {
                    element.remove();
                });

                // Xóa các địa điểm rỗng hoặc không hợp lệ trước khi thêm địa điểm mới vào mảng
                destinations = destinations.filter(destination => {
                    const isEmpty = !destination.location &&
                        !destination.district &&
                        !destination.ward &&
                        !destination.name &&
                        !destination.detailed_address &&
                        !destination.description &&
                        destination.images.length === 0;

                    const hasRequiredFields = destination.location &&
                        destination.district &&
                        destination.ward &&
                        destination.name &&
                        destination.detailed_address &&
                        destination.categories.length > 0 &&
                        destination.convenients.length > 0;

                    return !isEmpty && hasRequiredFields;
                });

                // Lấy giá trị từ các trường "huyện" và "xã"
                const districtSelect = document.getElementById('district_id');
                const wardSelect = document.getElementById('ward_id');
                const districtValue = districtSelect.options[districtSelect.selectedIndex].text !==
                    "Chọn huyện" ?
                    districtSelect.options[districtSelect.selectedIndex].text :
                    ""; // Nếu không chọn, đặt giá trị rỗng
                const wardValue = wardSelect.options[wardSelect.selectedIndex].text !== "Chọn xã" ?
                    wardSelect.options[wardSelect.selectedIndex].text :
                    ""; // Nếu không chọn, đặt giá trị rỗng
                const selectCategory = Array.from(document.querySelectorAll(
                    'input[name="categoriesAdd[]"]:checked')).map(checkbox => ({
                    id: checkbox.value,
                    name: checkbox.nextElementSibling.innerText.trim()
                }));
                const selectConvenient = Array.from(document.querySelectorAll(
                    'input[name="convenientsAdd[]"]:checked')).map(checkbox => ({
                    id: checkbox.value,
                    name: checkbox.nextElementSibling.innerText.trim()
                }));
                // Tạo địa điểm hiện tại với giá trị rỗng khi chưa chọn huyện hoặc xã
                const currentDestination = {
                    location: document.getElementById('location_id').value.trim(),
                    district: districtValue,
                    ward: wardValue,
                    district_code: document.getElementById('district_code').value.trim(),
                    ward_code: document.getElementById('ward_code').value.trim(),
                    name: document.getElementById('name').value.trim(),
                    detailed_address: document.getElementById('detailed_address').value.trim(),
                    description: document.getElementById('description').value.trim(),
                    categories: selectCategory,
                    convenients: selectConvenient,
                    images: Array.from(document.getElementById('imagesAdd').files)
                };

                // Kiểm tra xem địa điểm đã tồn tại trong mảng chưa
                const isAlreadyInDestinations = destinations.some(destination =>
                    destination.location === currentDestination.location &&
                    destination.district === currentDestination.district &&
                    destination.ward === currentDestination.ward &&
                    destination.name === currentDestination.name &&
                    destination.detailed_address === currentDestination.detailed_address &&
                    destination.categories === currentDestination.categories &&
                    destination.convenients === currentDestination.convenients
                );

                // Nếu địa điểm hiện tại chưa được thêm vào mảng thì thêm vào
                if (!isAlreadyInDestinations) {
                    destinations.push(currentDestination);
                }

                // Tạo FormData để gửi qua AJAX
                const formData = new FormData();
                destinations.forEach((destination, index) => {
                    formData.append(`destinations[${index}][location]`, destination.location);
                    formData.append(`destinations[${index}][district]`, destination.district);
                    formData.append(`destinations[${index}][ward]`, destination.ward);
                    formData.append(`destinations[${index}][district_code]`, destination
                        .district_code);
                    formData.append(`destinations[${index}][ward_code]`, destination.ward_code);
                    formData.append(`destinations[${index}][name]`, destination.name);
                    formData.append(`destinations[${index}][detailed_address]`, destination
                        .detailed_address);
                    formData.append(`destinations[${index}][description]`, destination.description);
                    destination.categories.forEach((category, i) => {
                        formData.append(`destinations[${index}][categoriesAdd][${i}]`,
                            category.id);
                    });
                    destination.convenients.forEach((convenient, i) => {
                        formData.append(`destinations[${index}][convenientsAdd][${i}]`,
                            convenient.id);
                    });
                    destination.images.forEach((file, i) => {
                        formData.append(`destinations[${index}][images][${i}]`, file);
                    });
                });
                // Gửi dữ liệu qua AJAX
                $.ajax({
                    url: '{{ route('admin.destinations.store') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        location.reload(); // Tải lại trang sau khi gửi thành công
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, messages) {
                            const fieldMap = {
                                'location': 'location_name',
                                'district': 'district_name',
                                'ward': 'ward_name',
                                'name': 'name',
                                'detailed_address': 'detailed_address',
                                'categoriesAdd': 'category_error',
                                'convenientsAdd': 'convenient_error'
                            };

                            const fieldKey = key.replace(/destinations\.\d+\./, '');
                            const formFieldName = fieldMap[fieldKey];

                            if (formFieldName) {
                                var inputElement;

                                if (formFieldName === 'category_error' ||
                                    formFieldName === 'convenient_error') {
                                    inputElement = document.querySelector(
                                        formFieldName === 'category_error' ?
                                        '[name="categoriesAdd[]"]' :
                                        '[name="convenientsAdd[]"]'
                                    );

                                    if (inputElement) {
                                        const container = inputElement.closest(
                                            '.sm\\:col-span-2');
                                        const existingMessage = container.querySelector(
                                            '.message');

                                        if (existingMessage) {
                                            existingMessage.remove();
                                        }

                                        const errorMessage = document.createElement(
                                            'div');
                                        errorMessage.classList.add('message',
                                            'text-red-700');
                                        errorMessage.textContent = messages[0];

                                        container.insertAdjacentElement('beforeend',
                                            errorMessage);
                                    }
                                } else {
                                    inputElement = document.querySelector(
                                        `[name="${formFieldName}"]`);

                                    if (inputElement) {
                                        const oldError = inputElement
                                            .nextElementSibling;
                                        if (oldError && oldError.classList.contains(
                                                'message')) {
                                            oldError.remove();
                                        }

                                        const errorMessage = document.createElement(
                                            'div');
                                        errorMessage.classList.add('message',
                                            'text-red-700');
                                        errorMessage.textContent = messages[0];

                                        inputElement.insertAdjacentElement('afterend',
                                            errorMessage);
                                    }
                                }
                            }
                        });
                    },
                    complete: function() {
                        // Mở lại nút khi hoàn tất xử lý
                        isSubmitting = false;
                        submitAllDestinationsButton.disabled = false;

                    }
                });
            });





            document.querySelector('.btn-ghost').addEventListener('click', function() {
                modal.close();
            });

        });
        let selectedFiles = [];

        function previewAddImages(event) {
            const preview = document.getElementById('previewAdd');
            const files = Array.from(event.target.files); // Chuyển đổi file list thành mảng



            files.forEach(file => {
                // Thêm file vào mảng selectedFiles nếu chưa có
                if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                    selectedFiles.push(file);

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div'); // Tạo div chứa img và nút xóa
                        imgContainer.classList.add('relative', 'inline-block', 'mr-2');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm', 'border',
                            'border-gray-300');

                        const removeButton = document.createElement('button'); // Tạo nút xóa
                        removeButton.innerText = 'X';
                        removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500', 'text-white',
                            'rounded-full', 'p-1');

                        // Sự kiện xóa ảnh khi click vào nút xóa
                        removeButton.onclick = function() {
                            imgContainer.remove(); // Xóa ảnh khỏi preview
                            selectedFiles = selectedFiles.filter(f => f !== file); // Xóa file khỏi mảng
                            updateSelectedFilesInput(); // Cập nhật lại input file sau khi xóa
                        };

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(removeButton);
                        preview.appendChild(imgContainer);
                    };

                    reader.readAsDataURL(file);
                }
            });

            updateSelectedFilesInput(); // Cập nhật input file với các file đã chọn
        }

        function updateSelectedFilesInput() {
            const input = document.getElementById('imagesAdd');
            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            input.files = dataTransfer.files; // Đồng bộ input với DataTransfer
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('modal_delete_destination');
            const formDeleteLocation = document.getElementById('form-delete-destination');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const destinationId = this.getAttribute('data-id');
                    formDeleteLocation.action = `/admin/destinations/delete/${destinationId}`;
                    deleteModal.showModal();
                });
            });

            // // Gửi form với Ajax khi nhấn nút xóa
            $(document).ready(function() {
                $('#submit_delete_destiantion').on('click', function(event) {
                    event.preventDefault(); // Ngăn không cho gửi form theo cách mặc định

                    var form = $('#form-delete-destination'); // Lấy đối tượng form
                    var formData = new FormData(form[0]); // Lấy dữ liệu từ form


                    $.ajax({
                        url: form.attr('action'), // Lấy URL action đã được thiết lập động
                        type: 'POST', // Phương thức gửi (POST)
                        data: formData, // Dữ liệu gửi đi
                        processData: false, // Ngăn jQuery xử lý dữ liệu vì chúng ta dùng FormData
                        contentType: false, // Ngăn jQuery đặt tiêu đề content-type
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Đảm bảo CSRF token
                        },
                        success: function(response, textStatus, xhr) {
                            if (xhr.status === 200 || xhr.status === 302) {
                                // Reset form sau khi thành công
                                form[0].reset();
                                // Reload lại trang sau vài giây (nếu cần)
                                setTimeout(function() {
                                    location.reload();
                                }, 2000); // Reload trang sau 2 giây
                            }
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {
                                var inputElement = $('[name="' + key + '"]');

                                // Xóa thông báo lỗi cũ trước khi chèn thông báo mới
                                inputElement.find(
                                    '.message');

                                // Chèn thông báo lỗi sau toàn bộ phần tử chứa Select2
                                inputElement.after(
                                    '<div class="message text-red-700">' +
                                    value[0] + '</div>');
                            });
                        }
                    });
                });
            });

            document.querySelector('#modal_delete_destination .btn-ghost').addEventListener('click', function() {
                deleteModal.close();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý mở modal chỉnh sửa
            const openModalButtons = document.querySelectorAll('button[title="Edit"]');
            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const destinationId = this.getAttribute('data-id');


                    // Fetch form to populate the modal for editing
                    fetch(`/admin/destinations/edit/${destinationId}/`, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            let existingModal = document.getElementById('modal_update_product');
                            if (existingModal) {
                                existingModal.remove(); // Remove existing modal if it exists
                            }
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modal = document.getElementById('modal_update_product');
                            if (modal) {
                                modal.showModal(); // Open modal

                                const closeModalButton = modal.querySelector(
                                    '#btn-close-modal');
                                if (closeModalButton) {
                                    closeModalButton.addEventListener('click', function() {
                                        modal.close(); // Close modal on button click
                                    });
                                }

                                // Khởi tạo Select2 cho các dropdown trong modal
                                const dropdownSettings = {
                                    dropdownParent: $(modal),
                                    allowClear: true,
                                    width: '100%'
                                };

                                $('#location_id_edit').select2({
                                    placeholder: "Chọn tỉnh",
                                    ...dropdownSettings
                                });
                                $('#district_id_edit').select2({
                                    placeholder: "Chọn huyện",
                                    ...dropdownSettings
                                });
                                $('#ward_id_edit').select2({
                                    placeholder: "Chọn xã",
                                    ...dropdownSettings
                                });

                                const selectedProvinceId = document.getElementById(
                                    'location_id_edit').value;
                                const selectedDistrictCode = document.getElementById(
                                    'district_id_edit').value;
                                const selectedWardCode = document.getElementById('ward_id_edit')
                                    .value;

                                if (selectedProvinceId) {
                                    loadDistrictAndWardByProvinceId(selectedProvinceId,
                                        selectedDistrictCode, selectedWardCode);
                                }

                                initializeLocationChangeHandler();
                                setupFormSubmission();
                                setupImageHandling();
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });

            function setupFormSubmission() {
                function updateDistrictAndWardCodes() {
                    var districtCode = $('#district_id_edit').val(); // Lấy mã huyện
                    var districtName = $('#district_id_edit option:selected').text(); // Lấy tên huyện

                    var wardCode = $('#ward_id_edit').val(); // Lấy mã xã
                    var wardName = $('#ward_id_edit option:selected').text(); // Lấy tên xã

                    // Cập nhật mã và tên huyện vào input ẩn
                    if (districtCode && districtName.trim() !== 'Chọn huyện') {
                        $('#district_code_edit').val(districtCode); // Gán giá trị mới vào input ẩn
                        $('#district_name').val(districtName);
                    } else {
                        console.log('Không có mã huyện hợp lệ được chọn');
                        $('#district_code_edit').val(''); // Xóa giá trị nếu không hợp lệ
                        $('#district_name').val('');
                    }

                    // Cập nhật mã và tên xã vào input ẩn
                    if (wardCode && wardName.trim() !== 'Chọn xã') {
                        $('#ward_code_edit').val(wardCode); // Gán giá trị mới vào input ẩn
                        $('#ward_name').val(wardName);
                    } else {
                        console.log('Không có mã xã hợp lệ được chọn');
                        $('#ward_code_edit').val(''); // Xóa giá trị nếu không hợp lệ
                        $('#ward_name').val('');
                    }
                }

                // Gọi hàm để cập nhật mã ngay khi có thay đổi
                $('#district_id_edit').on('change', updateDistrictAndWardCodes);
                $('#ward_id_edit').on('change', updateDistrictAndWardCodes);
                // Xử lý gửi form với Ajax
                $('#submit-edit-destination').on('click', function(event) {
                    event.preventDefault(); // Ngăn form gửi theo cách mặc định

                    var form = $('#form-edit-destination'); // Lấy form sửa

                    // Cập nhật lại các giá trị trong trường ẩn
                    updateDistrictAndWardCodes();

                    // Tạo FormData sau khi đã cập nhật các trường ẩn
                    var formData = new FormData(form[0]);



                    // Xóa tất cả các thông báo lỗi cũ
                    $('.message').remove();

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false, // Không xử lý dữ liệu
                        contentType: false, // Không đặt tiêu đề content-type
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // CSRF Token
                        },
                        success: function(response, textStatus, xhr) {
                            if (xhr.status === 200 || xhr.status === 302) {
                                form[0].reset(); // Reset form sau khi thành công
                                setTimeout(function() {
                                    location.reload(); // Reload lại trang nếu cần
                                }, 2000);
                            }
                        },
                        error: function(xhr) {
                            // Kiểm tra nếu có lỗi từ server trả về
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;

                                // Lặp qua các lỗi trả về từ server
                                $.each(errors, function(key, value) {
                                    // Xử lý lỗi cho danh mục
                                    if (key === 'categories') {
                                        // Lấy vùng chứa của các checkbox danh mục
                                        var categoryContainer = $('.grid-cols-3')
                                            .first(); // Giả sử danh mục là container đầu tiên
                                        categoryContainer.find('.message')
                                            .remove(); // Xóa thông báo cũ nếu có
                                        categoryContainer.after(
                                            '<div class="message text-red-700">' +
                                            value[0] + '</div>'
                                        ); // Thêm thông báo lỗi mới ngay sau vùng chứa danh mục
                                    } else if (key ===
                                        'convenients') { // Thêm xử lý cho tiện nghi
                                        // Lấy vùng chứa của các checkbox tiện nghi
                                        var convenientContainer = $('.grid-cols-3')
                                            .last(); // Giả sử tiện nghi là container thứ hai
                                        convenientContainer.find('.message')
                                            .remove(); // Xóa thông báo cũ nếu có
                                        convenientContainer.after(
                                            '<div class="message text-red-700">' +
                                            value[0] + '</div>'
                                        ); // Thêm thông báo lỗi mới ngay sau vùng chứa tiện nghi
                                    } else {
                                        // Xử lý các trường khác
                                        var inputElement = $('[name="' + key + '"]');
                                        inputElement.closest('.form-group').find(
                                            '.message').remove();
                                        inputElement.after(
                                            '<div class="message text-red-700">' +
                                            value[0] + '</div>'
                                        );
                                    }
                                });
                            }
                        }
                    });
                });
            }





            function initializeLocationChangeHandler() {
                $('#location_id_edit').on('change', function() {
                    const provinceId = $(this).val();
                    if (provinceId) {
                        loadDistrictAndWardByProvinceId(provinceId, '', '');
                    }
                });
            }

            function loadDistrictAndWardByProvinceId(provinceId, selectedDistrictCode, selectedWardCode) {
                // Lấy dữ liệu huyện từ file districts.json dựa trên tỉnh đã chọn
                fetch('/api/districts.json')
                    .then(response => response.json())
                    .then(responseData => {
                        const $districtSelect = $('#district_id_edit');
                        const $wardSelect = $('#ward_id_edit');

                        // Xóa các tùy chọn cũ và thêm tùy chọn mặc định
                        $districtSelect.empty().append('<option value="">Chọn huyện</option>').trigger(
                            'change');
                        $wardSelect.empty().append('<option value="">Chọn xã</option>').trigger('change');

                        // Lọc danh sách huyện theo mã tỉnh
                        const districts = responseData.filter(district => district.province_code == provinceId);

                        districts.forEach(district => {
                            const option = new Option(district.name, district.code, false, false);
                            $districtSelect.append(option);

                            if (district.code == selectedDistrictCode) {
                                $districtSelect.val(district.code).trigger('change');
                                loadWardsForDistrict(district.code, selectedWardCode);
                            }
                        });

                        $districtSelect.on('change', function() {
                            const districtId = $(this).val();
                            loadWardsForDistrict(districtId, '');
                        });
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            }

            function loadWardsForDistrict(districtId, selectedWardCode) {
                const $wardSelect = $('#ward_id_edit');
                $wardSelect.empty().append('<option value="">Chọn xã</option>');

                // Lấy dữ liệu xã từ file wards.json dựa trên huyện đã chọn
                fetch('/api/wards.json')
                    .then(response => response.json())
                    .then(responseData => {
                        // Lọc danh sách xã theo mã huyện
                        const wards = responseData.filter(ward => ward.district_code == districtId);

                        wards.forEach(ward => {
                            const option = new Option(ward.name, ward.code, false, false);
                            $wardSelect.append(option);

                            if (ward.code == selectedWardCode) {
                                $wardSelect.val(ward.code).trigger('change');
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching wards:', error));
            }

            // Image handling for preview and removal
            function setupImageHandling() {
                const imageInput = document.getElementById('images_edit');
                const previewContainer = document.getElementById('editpreview');

                imageInput.addEventListener('change', function(event) {
                    previewEditImages(event, previewContainer);
                });

                // Handle removal of existing images
                document.querySelectorAll('.remove-image').forEach(button => {
                    button.addEventListener('click', function() {
                        const imageId = this.getAttribute('data-image-id');
                        const imgContainer = this.closest('div');
                        imgContainer.remove(); // Remove image from preview

                        const deleteImagesInput = document.getElementById('deleted_images');
                        if (deleteImagesInput) {
                            const deletedImages = deleteImagesInput.value ? JSON.parse(
                                deleteImagesInput.value) : [];
                            deletedImages.push(imageId);
                            deleteImagesInput.value = JSON.stringify(deletedImages);
                        }
                    });
                });
            }

            // Preview new images before submitting
            function previewEditImages(event, previewContainer) {
                const files = Array.from(event.target.files);

                files.forEach(file => {
                    if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                        selectedFiles.push(file); // Add file to the list of selected files

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imgContainer = document.createElement('div');
                            imgContainer.classList.add('relative', 'inline-block', 'mr-2');

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm',
                                'border', 'border-gray-300');

                            const removeButton = document.createElement('button');
                            removeButton.innerText = 'X';
                            removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500',
                                'text-white', 'rounded-full', 'p-1');

                            removeButton.onclick = function() {
                                imgContainer.remove();
                                selectedFiles = selectedFiles.filter(f => f !== file);
                                updateSelectedFilesInput(); // Update hidden input after removal
                            };

                            imgContainer.appendChild(img);
                            imgContainer.appendChild(removeButton);
                            previewContainer.appendChild(imgContainer);
                        };

                        reader.readAsDataURL(file); // Read file as URL
                    }
                });

                updateSelectedFilesInput();
            }

            // Update hidden input with selected files
            function updateSelectedFilesInput() {
                const input = document.getElementById('images_edit');
                const dataTransfer = new DataTransfer();

                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file);
                });

                input.files = dataTransfer.files;
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm mở modal cho ảnh của destination
            function openDestinationImageModal(id) {
                const modal = document.getElementById(`destinationImageModal-${id}`);
                if (modal) modal.classList.remove('hidden'); // Hiển thị modal
            }

            // Hàm đóng modal cho ảnh của destination
            function closeDestinationImageModal(id) {
                const modal = document.getElementById(`destinationImageModal-${id}`);
                if (modal) modal.classList.add('hidden'); // Ẩn modal
            }

            // Gắn các hàm vào window để có thể gọi từ HTML
            window.openDestinationImageModal = openDestinationImageModal;
            window.closeDestinationImageModal = closeDestinationImageModal;
        });
    </script>
@endpush

@push('style')
    <style>
        .destination-image-modal {
            display: none;
        }

        .destination-image-modal.active {
            display: flex;
        }

        .destination-image-modal .modal-content {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            max-width: 90%;
            max-height: 80%;
            overflow-y: auto;
        }

        .destination-image-modal .close-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            font-size: 1.5rem;
            color: #e3342f;
            cursor: pointer;
        }

        #modal_add_product {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_add_product::-webkit-scrollbar {
            width: 8px;
        }

        #modal_add_product::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_add_product {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }

        #modal_update_product {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_update_product::-webkit-scrollbar {
            width: 8px;
        }

        #modal_update_product::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_update_product {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }
    </style>
@endpush
