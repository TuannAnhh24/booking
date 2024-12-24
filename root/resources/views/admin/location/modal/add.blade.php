
    <dialog id="modal_add_product" class="modal">
        <div class="modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
            </form>
            <h2 class="mb-4 text-xl font-bold text-gray-900"> {{ __('content.location.add_location') }}
            </h2>
            <section class="bg-white w-full flex justify-center">
                <div class="pt-4 pb-8 px-4 min-w-[60%]">
                    <form id="form-add-location" action="{{ route('admin.locations.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2 form-group">
                                <label for="name"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.location.name') }}
                                    <span style="color: red">*</span></label>
                                <select name="location_name" id="location_id_add"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 select2">
                                </select>
                                @error('location_name')
                                    <div class="message text-red-700">{{ $message }}</div>
                                @enderror
                                <!-- Input ẩn để lưu mã và tên tỉnh -->
                                <input type="hidden" name="code" id="code">
                                <input type="hidden" name="name" id="name">
                            </div>
                            <div class="sm:col-span-2 form-group">
                                <label for="description"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.location.description') }}</label>
                                <textarea id="description" name="description"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 "></textarea>
                                @error('description')
                                    <div class="message text-red-700">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-2 border border-gray-300 rounded-lg p-4 ">
                                <label class="text-base text-gray-500 font-semibold mb-2 block">   {{ __('content.location.select_characteristic') }}  <span style="color: red">*</span></label>
                                <div class="grid grid-cols-3 gap-4 form-group-characteristic">
                                    @foreach ($characteristics as $characteristic)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="characteristic{{ $characteristic->id }}" name="characteristicAdd[]" value="{{ $characteristic->id }}" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="characteristic_{{ $characteristic->id }}" class="ml-2 text-gray-700">{{ $characteristic->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('characteristic_error')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                            <div class="sm:col-span-2 form-group">
                                <label for="images"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.location.thumbnail') }}</label>
                                <input type="file" id="imagesAdd" name="images[]" class="hidden" multiple
                                    accept="image/*" onchange="previewAddImages(event)" />
                                <label for="imagesAdd"
                                    class="bg-white sm:col-span-2 text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto font-[sans-serif]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500"
                                        viewBox="0 0 32 32">
                                        <path
                                            d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" />
                                        <path
                                            d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" />
                                    </svg>
                                    {{ __('content.location.thumbnail') }}
                                </label>
                                <div id="previewAdd" class="flex flex-wrap gap-2 mt-2"></div>
                                <p class="text-xs text-gray-400 mt-2">PNG, JPG, SVG, WEBP, and GIF are allowed.</p>
                            </div>

                            @error('images')
                                <div class="message text-red-700">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="message"></div> <!-- Thông báo lỗi chung sẽ hiển thị ở đây -->

                        <button type="submit" id="submit-location"
                            class="py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent hover:text-white text-white text-md mr-4 hover:bg-[#316887] inline-flex items-center mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">
                            {{ __('content.location.add') }}
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </dialog>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            addValidation(
                document.querySelector('#location_id_add'),
                "This field is required.",
                value => value !== 'default'
            );
            const checkboxGroup = document.querySelectorAll('input[name="characteristicAdd[]"]');
            addValidation(
                checkboxGroup,
                "Please select at least one characteristic.",
                value => value === true // Nhóm checkbox hợp lệ nếu ít nhất một checkbox được chọn
            );
        })
    </script>
