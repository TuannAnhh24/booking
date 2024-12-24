<dialog id='modal_edit_rooms' class='modal'>
    <div class='modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4'>
        <button id='close_modal_button_edit' class='btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3'><i
                class="ri-close-line text-2xl"></i></button>
        <h2 class='mb-4 text-xl font-bold text-gray-900'>{{ __('content.room.update_room') }}</h2>
        <section class='bg-white w-full flex justify-center min-w-[600px]'>
            <div class='pt-4 pb-8 px-4 min-w-[60%]'>
                <form action='{{ route('admin.rooms.update', ['id' => $room->id]) }}' method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type='hidden' name='id' id='room_id' value="{{ $room->id }}" />

                    <!-- Tên phòng -->
                    <div class='sm:col-span-2'>
                        <label
                            class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.room.name') }}</label>
                        <input type='text' id='name' name="name" value="{{ $room->name }}"
                            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                            placeholder='Type product name' />
                        @error('name')
                            <div class="edit-error-message text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='sm:col-span-2'>
                        @isset($roomQuantity)
                            <label
                                class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.room.quantity') }}</label>
                            <input type='number' id='quantity' name="quantity" value="{{ $roomQuantity }}"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                placeholder='Type room quantity' />
                            @error('quantity')
                                <div class="error-message text-red-500">{{ $message }}</div>
                            @enderror
                        @endisset
                    </div>

                    <!-- Số lượng khách -->
                    <div class='sm:col-span-2'>
                        <label
                            class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.room.guest_quantity') }}</label>
                        <input type='number' id='guest_quantity' name="guest_quantity"
                            value="{{ $room->guest_quantity }}"
                            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                            placeholder='Type guest quantity' />
                        @error('guest_quantity')
                            <div class="error-message text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Điểm đến -->
                    <div class='sm:col-span-2'>
                        <label
                            class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.room.destination') }}</label>
                        <select name="destination_id" id="destination_id"
                            class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'>
                            @isset($destinations)
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}"
                                        {{ $room->destination_id == $destination->id ? 'selected' : '' }}>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        @error('destination_id')
                            <div class="error-message text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Biến thể -->
                    <div class="sm:col-span-2">
                        <label class="text-base text-gray-500 font-semibold mb-2 block">
                            {{ __('content.room.variant') }}
                        </label>
                        <div id="checkbox-grid">
                            @isset($variants)
                                @foreach ($variants as $variant)
                                    <div class="checkbox-item">
                                        <input type="checkbox" name="variant_id[]" value="{{ $variant->id }}"
                                            id="variant_{{ $variant->id }}"
                                            {{ $room->variants->pluck('id')->contains($variant->id) ? 'checked' : '' }} />
                                        <label for="variant_{{ $variant->id }}">{{ $variant->name }}</label>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>

                    <!-- Giá phòng -->
                    <div class='sm:col-span-2'>
                        <label
                            class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.room.price') }}</label>
                        @isset($prices)
                            <input type='number' id='price' name="price" value="{{ old('price', $prices) }}"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                placeholder='Type product price' />
                        @endisset
                        @error('price')
                            <div class="error-message text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Hình ảnh hiện có -->
                    <div id="existingImages" class="flex flex-wrap gap-2">
                        @foreach ($room->images as $image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $image->image) }}"
                                    class="h-32 w-32 object-cover rounded-md shadow-sm border border-gray-300" />
                                <button type="button" data-image-id="{{ $image->id }}"
                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 remove-image">✕</button>
                                <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                            </div>
                        @endforeach
                    </div>

                    <!-- Hình ảnh mới -->
                    <div class="sm:col-span-2">
                        <label for="images_edit"
                            class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.variant.image_up') }}</label>
                        <input type="file" id="images_edit" name="room_image[]" class="hidden" multiple
                            accept="image/*" onchange="previewImagesEdit(event)" />
                        <label for="images_edit"
                            class="bg-white sm:col-span-2 text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto font-[sans-serif]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500" viewBox="0 0 32 32">
                                <path
                                    d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" />
                                <path
                                    d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" />
                            </svg>
                            {{ __('content.variant.image_up') }}
                        </label>
                        <div id="previewEdit" class="flex flex-wrap gap-2 mt-2"></div>
                        <p class="text-xs text-gray-400 mt-2">{{ __('content.room.image_detail') }}</p>
                    </div>

                    <!-- Mô tả phòng -->
                    <div class='sm:col-span-2'>
                        <label
                            class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.room.description') }}</label>
                        <textarea id='description_edit'
                            class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500'
                            placeholder='Your description here' name="description">{{ $room->description }}</textarea>
                    </div>

                    <button type='submit'
                        class='py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent hover:text-white text-white text-md mr-4 hover:bg-[#316887] inline-flex items-center mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800'>
                        {{ __('content.room.edit') }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</dialog>
