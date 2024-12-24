<dialog id="modal_add_product" class="modal">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto  min-w-[850px] p-4">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        </form>
        <h2 class="mb-4 text-xl font-bold text-gray-900"> {{ __('content.destination.add_destination') }}
        </h2>

        <section class="bg-white w-full flex justify-center min-w-[600px] max-w-[650px]">
            <div class="pt-4 pb-8 px-4 min-w-[60%]">
                <!-- Form để nhập dữ liệu -->
                <form id="form-add-destination" action="{{ route('admin.destinations.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <!-- Các input nhập liệu ở đây -->
                        <div class="sm:col-span-2">
                            <label for="location"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.location') }}
                                <span style="color: red">*</span></label>
                            <select name="location_name" id="location_id"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 select2">
                                <option value="" selected>Chọn tỉnh</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->name }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                            @error('location_name')
                                <div class="message text-red-700">{{ $message }}</div>
                            @enderror
                            <!-- Phần chọn huyện -->
                            <label for="district"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.district') }}
                                <span style="color: red">*</span></label>
                            <select name="district_name" id="district_id"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 select2">
                                <option value=""></option>
                            </select>
                            @error('district_name')
                                <div class="message text-red-700">{{ $message }}</div>
                            @enderror
                            <!-- Phần chọn xã -->
                            <label for="ward"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.ward') }}
                                <span style="color: red">*</span></label>

                            <select name="ward_name" id="ward_id"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 select2">
                                <option value=""></option>
                            </select>
                        </div>

                        @error('ward_name')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                        <!-- Input ẩn cho mã và tên huyện -->
                        <input type="hidden" id="district_code" name="district_code" />
                        <!-- Input ẩn cho mã và tên xã -->
                        <input type="hidden" id="ward_code" name="ward_code" />


                        <!-- Input khác như tên, mô tả và hình ảnh -->
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.name_destination') }}
                                <span style="color: red">*</span></label>
                            <input type="text" id="name" name="name"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
                        </div>
                        @error('name')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                        <!-- Input khác như tên, mô tả và hình ảnh -->
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.detailed_address') }}
                                <span style="color: red">*</span></label>
                            <input type="text" id="detailed_address" name="detailed_address"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
                        </div>
                        @error('detailed_address')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-2">
                            <label for="description"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.description') }}</label>
                            <textarea id="description" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea>
                        </div>
                        @error('description')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                        {{-- Danh mục --}}
                        <div class="sm:col-span-2 border border-gray-300 rounded-lg p-4">
                            <label class="text-base text-gray-500 font-semibold mb-2 block">
                                {{ __('content.destination.category') }} <span style="color: red">*</span></label>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach ($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="category{{ $category->id }}" name="categoriesAdd[]"
                                            value="{{ $category->id }}"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="category_{{ $category->id }}"
                                            class="ml-2 text-gray-700">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        @error('category_error')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror

                        {{-- Tiện nghi --}}
                        <div class="sm:col-span-2 border border-gray-300 rounded-lg p-4">
                            <label class="text-base text-gray-500 font-semibold mb-2 block">
                                {{ __('content.destination.convenient') }} <span style="color: red">*</span></label>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach ($convenients as $convenient)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="convenient{{ $convenient->id }}" name="convenientsAdd[]"
                                            value="{{ $convenient->id }}"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="convenient_{{ $convenient->id }}"
                                            class="ml-2 text-gray-700">{{ $convenient->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        @error('convenient_error')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-2">
                            <label for="images"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.thumbnail') }}</label>
                            <input type="file" id="imagesAdd" name="images[]" class="hidden" multiple
                                accept="image/*" onchange="previewAddImages(event)" />
                            <label for="imagesAdd"
                                class="bg-white sm:col-span-2 text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500"
                                    viewBox="0 0 32 32">
                                    <path
                                        d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z">
                                    </path>
                                    <path
                                        d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z">
                                    </path>
                                </svg>
                                {{ __('content.destination.thumbnail') }}
                            </label>
                            <div id="previewAdd" class="flex flex-wrap gap-2 mt-2"></div>
                            <p class="text-xs text-gray-400 mt-2">PNG, JPG, SVG, WEBP, and GIF are allowed.</p>
                        </div>
                        @error('images')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nút thêm địa điểm mới -->
                    <button type="button" id="add-another-destination"
                        class="py-2 px-4 rounded-lg bg-[#EDA315] text-white mt-4">
                        {{ __('content.destination.add_another_destination') }}</button>

                    <!-- Nút submit để gửi toàn bộ địa điểm -->
                    <button type="submit" id="submit-all-destinations"
                        class="py-2 px-4 rounded-lg bg-[#316887] text-white mt-4">{{ __('content.destination.add_all_destination') }}</button>
                </form>

                <!-- Khu vực hiển thị danh sách các địa điểm đã thêm -->
                <div id="destination-list" class="mt-6">
                    <!-- Các địa điểm đã thêm sẽ hiển thị ở đây -->
                </div>
            </div>
        </section>
    </div>
</dialog>
<script>

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-add-destination');

    // Các input cần validate
    const fields = {
        location_name: document.getElementById('location_id'),
        district_name: document.getElementById('district_id'),
        ward_name: document.getElementById('ward_id'),
        name: document.getElementById('name'),
        detailed_address: document.getElementById('detailed_address'),
    };

    // Hàm kiểm tra lỗi
    const showError = (field, message) => {
        let errorDiv = field.parentNode.querySelector('.message');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.className = 'message text-red-700';
            field.parentNode.appendChild(errorDiv);
        }
        errorDiv.innerText = message;
    };

    // Hàm xóa lỗi
    const clearError = (field) => {
        const errorDiv = field.parentNode.querySelector('.message');
        if (errorDiv) errorDiv.remove();
    };

    // Hàm validate từng trường
    const validateField = (field) => {
        const value = field.value.trim();
        clearError(field);

        if (!value) {
            showError(field, 'Trường này là bắt buộc.');
            return false;
        }

        if (field.id === 'name' && value.length < 3) {
            showError(field, 'Tên phải có ít nhất 3 ký tự.');
            return false;
        }

        return true;
    };

    // Gắn sự kiện `oninput` và `onblur` cho từng input
    Object.values(fields).forEach(field => {
        field.addEventListener('input', () => validateField(field));
        field.addEventListener('blur', () => validateField(field));
    });

    // Validate toàn bộ form khi submit
    form.addEventListener('submit', (e) => {
        let isValid = true;

        Object.values(fields).forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault(); // Ngăn chặn gửi form nếu có lỗi
        }
    });
});
</script>