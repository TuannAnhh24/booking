<dialog id="modal_update_product" class="modal">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4">
        <button id="btn-close-modal" class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        <h2 class="mb-4 text-xl font-bold text-gray-900">
            {{ __('content.destination.edit_destination') }}</h2>
        <section class="bg-white w-full flex justify-center min-w-[600px]">
            <div class="pt-4 pb-8 px-4 min-w-[60%]">

                <form id="form-edit-destination"
                    action="{{ route('admin.destinations.update', ['id' => $destination->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <input type="hidden" id="destination-id" name="destination_id" value="{{ $destination->id }}">

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                        <div class="sm:col-span-2">
                            @foreach ($destination->locations as $location)
                                @php
                                    // Tách địa chỉ thành các phần bằng dấu phẩy, đảm bảo kiểm tra sự tồn tại của 'pivot'
                                    $addressParts = isset($location->pivot->address)
                                        ? explode(',', $location->pivot->address)
                                        : ['', ''];
                                    $district = $addressParts[0] ?? ''; // Lấy tên Huyện
                                    $ward = $addressParts[1] ?? ''; // Lấy tên Xã

                                    // Kiểm tra pivot tồn tại trước khi truy xuất district_code và ward_code
                                    $districtCode = $location->pivot->district_code ?? ''; // Mã huyện
                                    $wardCode = $location->pivot->ward_code ?? ''; // Mã xã
                                @endphp
                            @endforeach

                            <label for="location" class="text-base text-gray-500 font-semibold mb-2 block">
                                {{ __('content.destination.location') }} <span style="color: red">*</span></label>
                            </label>

                            <select name="location_name" id="location_id_edit"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 select2">
                                <option value="">Chọn tỉnh</option>
                                @foreach ($locations as $location)
                                    @php
                                        // Lấy location_id từ bảng pivot
                                        $selectedLocationId =
                                            $destination->locations->first()->pivot->location_id ?? null;
                                    @endphp
                                    <option value="{{ $location->code }}"
                                        {{ $selectedLocationId == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('location_name')
                                <div class="message text-red-700">{{ $message }}</div>
                            @enderror

                            <!-- Dropdown chọn huyện -->
                            <label for="district"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.district') }}
                                <span style="color: red">*</span></label>
                            <select name="district_name" id="district_id_edit" data-name="{{ $district ?? '' }}"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
                                <option value="{{ $districtCode }}">{{ $district ?? 'Chọn huyện' }}</option>
                            </select>
                            @error('district_name')
                                <div class="message text-red-700">{{ $message }}</div>
                            @enderror

                            <!-- Dropdown chọn xã -->
                            <label for="ward"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.ward') }}
                                <span style="color: red">*</span></label>
                           
                            <select name="ward_name" id="ward_id_edit"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 select2">
                            <option value="{{ $wardCode }}">{{ $ward ?? 'Chọn xã' }}</option>
                        </select>
                            @error('ward_name')
                                <div class="message text-red-700">{{ $message }}</div>
                            @enderror

                            <!-- Hidden inputs cho mã huyện và xã -->
                            <input type="hidden" id="district_code_edit" name="district_code_edit"
                                value="{{ $districtCode }}" />
                            <input type="hidden" id="ward_code_edit" name="ward_code_edit"
                                value="{{ $wardCode }}" />
                            <input type="hidden" id="district_name" name="district_name_edit" value="" />
                            <input type="hidden" id="ward_name" name="ward_name_edit" value="" />
                        </div>


                        <div class="sm:col-span-2">
                            <div class="sm:col-span-2">
                                <label for="name"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.name_destination') }}</label>
                                <input type="text" name="name" id="name" value="{{ $destination->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                        </div>
                        @error('name')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                        <div class="sm:col-span-2">
                            <div class="sm:col-span-2">
                                <label for="detailed_address"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.detailed_address') }}</label>
                                <input type="text" name="detailed_address" id="detailed_address"
                                    value="{{ $destination->detailed_address }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                        </div>
                        @error('detailed_address')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-2">
                            <label for="description"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.description') }}</label>
                            <textarea id="description" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Your description here">{{ $destination->description }}</textarea>
                        </div>
                        {{-- Danh mục --}}
                        <div class="sm:col-span-2 border border-gray-300 rounded-lg p-4">
                            <label class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.category') }}</label>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach ($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            {{ $destination->categories->contains($category->id) ? 'checked' : '' }} />
                                        <label class="ml-2">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('category_error')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                        {{-- Tiện nghi --}}
                        <div class="sm:col-span-2 border border-gray-300 rounded-lg p-4">
                            <label class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.destination.convenient') }}</label>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach ($convenients as $convenient)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="convenients[]" value="{{ $convenient->id }}"
                                            {{ $destination->convenients->contains($convenient->id) ? 'checked' : '' }} />
                                        <label class="ml-2">{{ $convenient->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('convenient_error')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror

                        <div id="existingImages" class="flex flex-wrap gap-2 mt-4">
                            @foreach ($destination->images as $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image->image) }}"
                                        class="h-32 w-32 object-cover rounded-md shadow-sm border border-gray-300" />
                                    <button type="button" data-image-id="{{ $image->id }}"
                                        class="absolute top-2 right-2 text-red-600 bg-red-100 rounded-full w-8 h-8 flex items-center justify-center remove-image"><i class="ri-close-line"></i></button>
                                    <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="sm:col-span-2 mt-4">
                            <label for="images_edit" class="text-base text-gray-500 font-semibold mb-2 block">Upload
                                New Images</label>
                            <input type="file" id="images_edit" name="destination_image[]" class="hidden"
                                multiple accept="image/*" />
                            <label for="images_edit"
                                class="bg-white text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500"
                                    viewBox="0 0 32 32">
                                    <path
                                        d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" />
                                    <path
                                        d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" />
                                </svg>
                                Upload New Images
                            </label>

                            <div id="editpreview" class="flex flex-wrap gap-2 mt-2"></div>
                        </div>
                    </div>

                    <button type="submit" id="submit-edit-destination"
                        class="py-2 px-4 rounded-lg bg-[#EDA315] hover:bg-[#316887] text-white mt-4 sm:mt-6 text-sm font-medium">
                        {{ __('content.destination.edit') }}
                    </button>
                </form>

            </div>
        </section>
    </div>
</dialog>
