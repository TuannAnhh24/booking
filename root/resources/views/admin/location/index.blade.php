@extends('admin.layouts.master-layout')
@section('content')
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
            <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class='flex items-center justify-between gap-8 mb-8'>
                        <div>
                            <h5
                                class='block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900'>
                                {{ __('content.location.location_list') }}
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
                                    <form id="searchForm" method="GET" action="{{ route('admin.locations.index') }}">
                                        <input id="search" name="keyword"
                                            class='peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50'
                                            placeholder='' />
                                        <label
                                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all">
                                            {{ __('content.user.search') }}
                                        </label>
                                    </form>
                                </div>
                            </div>

                            <div class="dropdown">
                                <button type="button"
                                    class="dropdown-toggle select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"><i
                                        class="ri-more-2-fill"></i></button>
                                <ul
                                    class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                    <li>
                                        <a href="{{ route('admin.locations.trash') }}"
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
                                {{ __('content.location.add') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    ID</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.location.code') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.location.name') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.location.thumbnail') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.location.description') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.location.action') }}</th>
                            </tr>
                        </thead>

                        <tbody id="location-list">
                            @include('admin.location.partials.table')
                        </tbody>
                    </table>
                    <div class="w-full flex justify-between items-center p-0">
                        {{ $locations->links('admin.layouts.pagination') }}
                    </div>
                </div>
                @include('admin.location.modal.add')
                @include('admin.location.modal.delete')
                @isset($location)
                    @include('admin.location.modal.edit')
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
            const selectElement = document.getElementById('location_id_add');
            const submitButton = document.getElementById('submit-location');
            const provinceCodeInput = document.getElementById('code');
            const provinceNameInput = document.getElementById('name');
            const form = document.getElementById('form-add-location');

            let isFetchingProvinces = false; // Cờ để kiểm tra đang tải dữ liệu tỉnh/thành phố
            let isSubmitting = false; // Cờ để kiểm tra trạng thái gửi form

            // Mở modal khi nhấn nút mở modal
            if (openModalButton) {
                openModalButton.addEventListener('click', function() {
                    modal.showModal();

                    // Xóa các option cũ trong dropdown để tránh trùng lặp
                    $(selectElement).empty();

                    // Thêm tùy chọn mặc định vào dropdown
                    const defaultOption = new Option("Chọn Tỉnh/Thành Phố", "", true, true);
                    selectElement.add(defaultOption);

                    if (isFetchingProvinces) return; // Nếu đang tải dữ liệu, bỏ qua

                    isFetchingProvinces = true; // Đặt cờ để ngăn chặn tải lặp
                    fetch('/api/provinces.json')
                        .then(response => response.json())
                        .then(responseData => {
                            isFetchingProvinces = false; // Đặt lại cờ khi hoàn tất

                            const provinces = responseData.data || responseData; // Kiểm tra dữ liệu
                            if (Array.isArray(provinces)) {
                                provinces.forEach(province => {
                                    const option = new Option(province.name, province.code,
                                        false, false);
                                    selectElement.add(option);
                                });

                                // Khởi tạo Select2 cho dropdown
                                $(selectElement).select2({
                                    placeholder: 'Chọn Tỉnh/Thành Phố',
                                    dropdownParent: $(modal),
                                    allowClear: true,
                                    width: '100%' // Đảm bảo độ rộng của dropdown là 100%
                                });
                            } else {
                                console.error("Dữ liệu tỉnh/thành phố không hợp lệ:", provinces);
                            }
                        })
                        .catch(error => {
                            isFetchingProvinces = false; // Đặt lại cờ trong trường hợp lỗi
                            console.error("Có lỗi khi tải dữ liệu tỉnh/thành phố:", error);
                        });
                });
            }

            // Cập nhật input ẩn khi người dùng chọn tỉnh
            if (selectElement) {
                $(selectElement).off('change').on('change', function() {
                    const selectedOption = $(this).find('option:selected');
                    if (provinceCodeInput && provinceNameInput) {
                        provinceCodeInput.value = selectedOption.val();
                        provinceNameInput.value = selectedOption.text();
                    }
                });
            }

            // Đóng modal khi nhấn ngoài vùng modal
            if (modal) {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.close();
                    }
                });
            }

            // Gửi form với Ajax
            $(document).ready(function() {
                $('#submit-location').off('click').on('click', function(event) {
                    event.preventDefault(); // Ngăn chặn hành vi mặc định của form

                    if (isSubmitting) return; // Nếu đang gửi, bỏ qua click mới
                    isSubmitting = true; // Đặt cờ trạng thái đang gửi

                    var form = $('#form-add-location');
                    var formData = new FormData(form[0]);

                    // Xóa các thông báo lỗi cũ
                    $('.message').html('');

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false, // Ngăn xử lý dữ liệu vì sử dụng FormData
                        contentType: false, // Không đặt tiêu đề content-type mặc định
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response, textStatus, xhr) {
                            if (xhr.status === 200 || xhr.status === 302) {
                                form[0].reset(); // Reset form
                                setTimeout(() => location.reload(),
                                    2000); // Reload trang sau 2 giây
                            }
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON.errors;

                            // Hiển thị lỗi cho từng trường
                            $.each(errors, function(key, value) {
                                var inputElement = $('[name="' + key + '"]');
                                inputElement.closest('.form-group').find(
                                    '.message').remove();
                                var parentElement = inputElement.parent();
                                parentElement.after(
                                    '<div class="message text-red-700">' +
                                    value[0] + '</div>');
                            });
                            // Kiểm tra xem có lỗi cho characteristicAdd không
                            if (errors.characteristicAdd) {
                                // Hiển thị thông báo lỗi cho characteristicAdd
                                var characteristicMessage = errors.characteristicAdd[
                                    0]; // Lấy thông báo lỗi đầu tiên
                                // Tìm phần tử cha bao quanh checkbox
                                $('.form-group-characteristic:last').after(
                                    '<div class="message text-red-700">' +
                                    characteristicMessage + '</div>');
                            }
                        },
                        complete: function() {
                            isSubmitting = false; // Đặt lại trạng thái sau khi hoàn tất
                        }
                    });
                });
            });
        });

        let selectedFiles = []; // Mảng để lưu trữ các file đã chọn
        function previewAddImages(event) {
            const preview = document.getElementById('previewAdd');
            const files = Array.from(event.target.files); // Chuyển đổi file list thành mảng

            files.forEach(file => {
                // Kiểm tra xem file đã được chọn trước đó chưa
                if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                    selectedFiles.push(file); // Thêm file vào danh sách đã chọn

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div'); // Tạo một div chứa img và nút xóa
                        imgContainer.classList.add('relative', 'inline-block', 'mr-2'); // Class cho div

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm', 'border',
                            'border-gray-300');

                        const removeButton = document.createElement('button'); // Tạo nút xóa
                        removeButton.innerText = 'X';
                        removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500', 'text-white',
                            'rounded-full', 'p-1');

                        // Thêm sự kiện click cho nút xóa
                        removeButton.onclick = function() {
                            imgContainer.remove(); // Xóa ảnh khỏi preview
                            selectedFiles = selectedFiles.filter(f => f !== file); // Xóa file khỏi mảng
                            updateSelectedFilesInput(); // Cập nhật input ẩn sau khi xóa
                        };

                        imgContainer.appendChild(img); // Thêm img vào div
                        imgContainer.appendChild(removeButton); // Thêm nút xóa vào div
                        preview.appendChild(imgContainer); // Thêm div vào preview
                    };

                    reader.readAsDataURL(file); // Đọc file dưới dạng URL
                }
            });

            updateSelectedFilesInput(); // Cập nhật input ẩn với danh sách file đã chọn
        }

        // Cập nhật input ẩn với các file đã chọn
        function updateSelectedFilesInput() {
            const input = document.getElementById('imagesAdd'); // Lấy input file
            const dataTransfer = new DataTransfer(); // Tạo đối tượng DataTransfer

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file); // Thêm file vào DataTransfer
            });

            input.files = dataTransfer.files; // Gán các file vào input
        }
    </script>

    <script>
        function addValidation(inputElements, errorMessage, validateFn) {
            if (!inputElements || typeof validateFn !== 'function') {
                console.error("Invalid input elements or validation function.");
                return;
            }

            // Nếu là một nhóm checkbox, inputElements là một NodeList hoặc mảng
            const isCheckboxGroup = inputElements instanceof NodeList || Array.isArray(inputElements);
            const firstElement = isCheckboxGroup ? inputElements[0] : inputElements;

            // Tìm và xóa lỗi cũ nếu tồn tại
            let errorElement = firstElement.parentNode.querySelector('.update-error');
            if (errorElement) {
                errorElement.remove();
            }

            // Tạo phần tử hiển thị lỗi
            const errorSpan = document.createElement('span');
            errorSpan.classList.add('update-error', 'text-red-500', 'text-sm', 'hidden');
            errorSpan.textContent = errorMessage;
            firstElement.parentNode.parentNode.appendChild(errorSpan); // Thêm lỗi vào bên ngoài nhóm

            // Hàm lấy giá trị
            const getValue = () => {
                if (isCheckboxGroup) {
                    // Lấy danh sách các checkbox được chọn
                    return Array.from(inputElements).some(checkbox => checkbox.checked);
                }
                if (firstElement.type === 'checkbox') {
                    return firstElement.checked;
                }
                return firstElement.value;
            };

            // Hàm hiển thị lỗi
            const showError = () => {
                if (!validateFn(getValue())) {
                    errorSpan.classList.remove('hidden');
                } else {
                    errorSpan.classList.add('hidden');
                }
            };

            // Lắng nghe sự kiện
            if (isCheckboxGroup) {
                inputElements.forEach(input => input.addEventListener('change', showError));
            } else {
                firstElement.addEventListener('blur', showError);
                firstElement.addEventListener('change', showError);
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý hiển thị modal xóa và đặt action cho form
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('modal_delete_location');
            const formDeleteLocation = document.getElementById('form-delete-location');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const locationId = this.getAttribute('data-id');
                    // Thiết lập action của form dựa trên locationId
                    formDeleteLocation.action = `/admin/locations/delete/${locationId}`;
                    deleteModal.showModal(); // Hiển thị modal
                });
            });

            // // Gửi form với Ajax khi nhấn nút xóa
            $(document).ready(function() {
                $('#submit_delete_location').on('click', function(event) {
                    event.preventDefault(); // Ngăn không cho gửi form theo cách mặc định

                    var form = $('#form-delete-location'); // Lấy đối tượng form
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

            // Xử lý nút đóng modal
            document.querySelector('#modal_delete_location .btn-ghost').addEventListener('click', function() {
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
                    const locationId = this.getAttribute('data-id');

                    // Fetch form để populate modal
                    fetch(`/admin/locations/edit/${locationId}/`, {
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
                                existingModal.remove(); // Remove modal cũ nếu có
                            }
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modal = document.getElementById('modal_update_product');

                            if (modal) {
                                modal.showModal();

                                // Fetch tỉnh thành từ API và thêm vào dropdown Select2
                                // Fetch tỉnh thành từ API và thêm vào dropdown Select2
                                const selectElement = document.getElementById(
                                    'location_id_edit');
                                const codeInput = document.getElementById('code_edit');
                                const nameInput = document.getElementById('name_edit');
                                const currentCode = codeInput.value;

                                fetch('/api/provinces.json')
                                    .then(response => response.json())
                                    .then(responseData => {
                                        console.log('Response Data:', responseData);

                                        // Kiểm tra nếu responseData có chứa mảng data; nếu không, sử dụng responseData trực tiếp
                                        const provinces = responseData.data || responseData;

                                        if (Array.isArray(provinces)) {
                                            provinces.forEach(province => {
                                                // Tạo option với tên và mã tỉnh từ dữ liệu API
                                                const option = new Option(province
                                                    .name, province.code);
                                                selectElement.add(option);
                                            });

                                            // Khởi tạo Select2 sau khi thêm dữ liệu
                                            $(selectElement).select2({
                                                placeholder: 'Chọn Tỉnh/Thành Phố',
                                                allowClear: true,
                                                dropdownParent: $(
                                                    modal
                                                ), // Đảm bảo dropdown hiển thị trong modal
                                                width: '100%' // Đảm bảo độ rộng 100% cho select
                                            });

                                            // Đặt giá trị hiện tại nếu có mã tỉnh/thành phố được chọn sẵn
                                            if (currentCode) {
                                                $(selectElement).val(currentCode).trigger(
                                                    'change');
                                            }
                                        } else {
                                            console.error(
                                                "Dữ liệu tỉnh thành không phải là mảng:",
                                                provinces);
                                        }
                                    })
                                    .catch(error => console.error(
                                        'Có lỗi khi lấy dữ liệu tỉnh thành:', error));


                                // Lắng nghe sự kiện thay đổi của dropdown
                                $(selectElement).on('change', function() {
                                    const selectedOption = $(this).find(
                                        'option:selected');
                                    if (selectedOption) {
                                        codeInput.value = selectedOption
                                            .val(); // Cập nhật mã tỉnh
                                        nameInput.value = selectedOption
                                            .text(); // Cập nhật tên tỉnh
                                    }
                                });

                                // Xử lý gửi form với Ajax
                                $('#submit-edit-location').on('click', function(event) {
                                    event
                                        .preventDefault(); // Ngăn gửi form theo cách mặc định
                                    // Nếu đã chọn tỉnh/thành phố, tiếp tục gửi form
                                    var form = $('#form-edit-location'); // Lấy form sửa
                                    var formData = new FormData(form[
                                        0]); // Thu thập dữ liệu form
                                    for (var pair of formData.entries()) {
                                        console.log(pair[0] + ', ' + pair[1]);
                                    }
                                    $.ajax({
                                        url: form.attr(
                                            'action'), // URL gửi dữ liệu
                                        type: 'POST', // Phương thức gửi (POST)
                                        data: formData, // Dữ liệu gửi đi
                                        processData: false, // Ngăn jQuery xử lý dữ liệu
                                        contentType: false, // Ngăn jQuery đặt tiêu đề content-type
                                        headers: {
                                            'X-CSRF-TOKEN': $(
                                                    'meta[name="csrf-token"]')
                                                .attr('content') // CSRF Token
                                        },
                                        success: function(response, textStatus,
                                            xhr) {
                                            if (xhr.status === 200 || xhr
                                                .status === 302) {
                                                // Reset form sau khi thành công
                                                form[0].reset();
                                                // Reload lại trang sau vài giây (nếu cần)
                                                setTimeout(function() {
                                                        location
                                                            .reload();
                                                    },
                                                    2000
                                                ); // Reload trang sau 2 giây
                                            }
                                        },
                                        error: function(xhr) {
                                            var errors = xhr.responseJSON
                                                .errors;

                                            $.each(errors, function(key,
                                                value) {
                                                var inputElement =
                                                    $('[name="' +
                                                        key + '"]');

                                                // Xóa thông báo lỗi cũ trước khi chèn thông báo mới
                                                inputElement
                                                    .closest(
                                                        '.form-group'
                                                    ).find(
                                                        '.message')
                                                    .remove();

                                                // Tìm phần tử cha bao quanh cả select2 và span của nó
                                                var parentElement =
                                                    inputElement
                                                    .parent(); // Bạn có thể điều chỉnh nếu Select2 bao trong phần tử khác

                                                // Chèn thông báo lỗi sau toàn bộ phần tử chứa Select2
                                                parentElement.after(
                                                    '<div class="message text-red-700">' +
                                                    value[0] +
                                                    '</div>');
                                            });
                                            // Kiểm tra xem có lỗi cho characteristicAdd không
                                            if (errors
                                                .characteristicsEdit) {
                                                // Hiển thị thông báo lỗi cho characteristicAdd
                                                var characteristicMessage =
                                                    errors
                                                    .characteristicsEdit[
                                                        0
                                                    ]; // Lấy thông báo lỗi đầu tiên
                                                $('.form-group-characteristic:last')
                                                    .after(
                                                        '<div class="message text-red-700">' +
                                                        characteristicMessage +
                                                        '</div>');
                                            }


                                        }
                                    });
                                });

                                // Đóng modal khi nhấn nút đóng
                                const closeModalButton = modal.querySelector(
                                    '#btn-close-modal');
                                if (closeModalButton) {
                                    closeModalButton.addEventListener('click', function() {
                                        modal.close();
                                    });
                                }

                                // Xử lý xóa ảnh cũ
                                const removeImageButtons = modal.querySelectorAll(
                                    '.remove-image');
                                removeImageButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        this.closest('div').remove();
                                    });
                                });

                                // Xử lý preview ảnh mới tải lên
                                const imageInputEdit = document.getElementById('images_edit');
                                if (imageInputEdit) {
                                    imageInputEdit.removeEventListener('change',
                                        previewEditImages);
                                    imageInputEdit.addEventListener('change',
                                        previewEditImages);
                                }
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });

            let selectedFiles = []; // Mảng để lưu trữ các file đã chọn

            // Hàm xử lý preview hình ảnh trước khi submit
            function previewEditImages(event) {
                const preview = document.getElementById('editpreview');
                const files = Array.from(event.target.files); // Chuyển đổi file list thành mảng

                files.forEach(file => {
                    // Kiểm tra xem file đã được chọn trước đó chưa
                    if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                        selectedFiles.push(file); // Thêm file vào danh sách đã chọn

                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const imgContainer = document.createElement(
                                'div'); // Tạo một div chứa img và nút xóa
                            imgContainer.classList.add('relative', 'inline-block',
                                'mr-2'); // Class cho div

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm',
                                'border', 'border-gray-300');

                            const removeButton = document.createElement('button'); // Tạo nút xóa
                            removeButton.innerText = 'X';
                            removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500',
                                'text-white', 'rounded-full', 'p-1');

                            // Thêm sự kiện click cho nút xóa
                            removeButton.onclick = function() {
                                imgContainer.remove(); // Xóa ảnh khỏi preview
                                selectedFiles = selectedFiles.filter(f => f !==
                                    file); // Xóa file khỏi mảng
                                updateSelectedFilesInput(); // Cập nhật input ẩn sau khi xóa
                            };

                            imgContainer.appendChild(img); // Thêm img vào div
                            imgContainer.appendChild(removeButton); // Thêm nút xóa vào div
                            preview.appendChild(imgContainer); // Thêm div vào preview
                        };

                        reader.readAsDataURL(file); // Đọc file dưới dạng URL
                    }
                });

                updateSelectedFilesInput(); // Cập nhật input ẩn với danh sách file đã chọn
            }

            // Cập nhật input ẩn với các file đã chọn
            function updateSelectedFilesInput() {
                const input = document.getElementById('images_edit'); // Lấy input file
                const dataTransfer = new DataTransfer(); // Tạo đối tượng DataTransfer

                selectedFiles.forEach(file => {
                    dataTransfer.items.add(file); // Thêm file vào DataTransfer
                });

                input.files = dataTransfer.files; // Gán các file vào input
            }
        });

        // //Ajax tìm kiếm
        $(document).ready(function() {
            $("#search").on('keyup', debounce(function() {
                let keyword = $(this).val();
                $.ajax({
                    url: $('#searchForm').attr('action'),
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(response) {
                        console.log(response);
                        $('#location-list').html(response.html);
                        attachModalEvents();
                    },
                    error: function() {
                        console.log('Error' + error);
                    }
                });
            }, 500));
        });

        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this,
                    args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        function attachModalEvents() {
            // Xử lý hiển thị modal xóa và đặt action cho form
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('modal_delete_location');
            const formDeleteLocation = document.getElementById('form-delete-location');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const locationId = this.getAttribute('data-id');
                    // Thiết lập action của form dựa trên locationId
                    formDeleteLocation.action = `/admin/locations/delete/${locationId}`;
                    deleteModal.showModal(); // Hiển thị modal
                });
            });

            // Xử lý mở modal chỉnh sửa
            const openModalButtons = document.querySelectorAll('button[title="Edit"]');
            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const locationId = this.getAttribute('data-id');

                    // Fetch form để populate modal
                    fetch(`/admin/locations/edit/${locationId}/`, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            let existingModal = document.getElementById('modal_update_product');
                            if (existingModal) {
                                existingModal.remove();
                            }
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modal = document.getElementById('modal_update_product');

                            if (modal) {
                                modal.showModal();

                                handleModalFormEvents(modal);
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        }

        // Gắn sự kiện cho các nút trong modal
        function handleModalFormEvents(modal) {
            // Fetch tỉnh thành từ API và xử lý Select2
            // Fetch tỉnh thành từ API và thêm vào dropdown Select2
            const selectElement = document.getElementById('location_id_edit');
            const codeInput = document.getElementById('code_edit');
            const nameInput = document.getElementById('name_edit');
            const currentCode = codeInput.value;

            fetch('https://esgoo.net/api-tinhthanh/1/0.htm')
                .then(response => response.json())
                .then(responseData => {
                    // Lấy mảng data từ response
                    const provinces = responseData.data;

                    provinces.forEach(province => {
                        // Sử dụng province.id thay cho province.code để phù hợp với API mới
                        const option = new Option(province.name, province.id);
                        selectElement.add(option);
                    });

                    // Khởi tạo Select2
                    $(selectElement).select2({
                        placeholder: 'Chọn Tỉnh/Thành Phố',
                        allowClear: true,
                        dropdownParent: $(modal), // Đảm bảo dropdown hiển thị trong modal
                        width: '100%'
                    });

                    // Đặt tỉnh/thành phố hiện tại được chọn sẵn
                    $(selectElement).val(currentCode).trigger('change');
                })
                .catch(error => console.error('Có lỗi khi lấy dữ liệu tỉnh thành:', error));

            // Lắng nghe sự kiện thay đổi của dropdown
            $(selectElement).on('change', function() {
                const selectedOption = $(this).find('option:selected');
                if (selectedOption) {
                    codeInput.value = selectedOption.val(); // Cập nhật mã tỉnh
                    nameInput.value = selectedOption.text(); // Cập nhật tên tỉnh
                }
            });

            // Đóng modal khi nhấn nút đóng
            const closeModalButton = modal.querySelector('#btn-close-modal');
            if (closeModalButton) {
                closeModalButton.addEventListener('click', function() {
                    modal.close();
                });
            }

            // Xử lý xóa ảnh cũ
            const removeImageButtons = modal.querySelectorAll('.remove-image');
            removeImageButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('div').remove();
                });
            });

            // Xử lý preview ảnh mới tải lên
            const imageInputEdit = document.getElementById('images_edit');
            if (imageInputEdit) {
                imageInputEdit.removeEventListener('change', previewEditImages);
                imageInputEdit.addEventListener('change', previewEditImages);
            }
        }

        attachModalEvents();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm mở modal hiển thị tất cả ảnh
            function openImageGalleryModal(id) {
                const modal = document.getElementById(`imageGalleryModal-${id}`);
                if (modal) modal.classList.remove('hidden'); // Hiển thị modal
            }

            // Hàm đóng modal hiển thị tất cả ảnh
            function closeImageGalleryModal(id) {
                const modal = document.getElementById(`imageGalleryModal-${id}`);
                if (modal) modal.classList.add('hidden'); // Ẩn modal
            }

            // Gắn hàm vào window để có thể gọi từ HTML
            window.openImageGalleryModal = openImageGalleryModal;
            window.closeImageGalleryModal = closeImageGalleryModal;
        });
    </script>
@endpush


@push('style')
    <style>
        .image-gallery-modal {
            display: none;
        }

        .image-gallery-modal.active {
            display: flex;
        }

        .image-gallery-modal .modal-content {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            max-width: 90%;
            max-height: 80%;
            overflow-y: auto;
        }

        .image-gallery-modal .close-btn {
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
