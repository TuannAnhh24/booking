
<dialog id="modal_update_product" class="modal">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center min-w-[850px] p-4">
        <button id="btn-close-modal" class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        <h2 class="mb-4 text-xl font-bold text-gray-900">   {{ __('content.location.edit_location') }}</h2>

        <section class="bg-white w-full flex justify-center">
            <div class="pt-4 pb-8 px-4 mx-auto max-w-2xl min-w-[60%]">
                    <form id="form-edit-location" action="{{ route('admin.locations.update', ['id' => $location->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')


                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                            <div class="sm:col-span-2 form-group">
                                <label for="name"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.location.name') }}
                                    <span style="color: red">*</span></label>
                                <select name="location_name" id="location_id_edit"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
                                    <option value="{{ $location->code }}">{{ $location->name }}</option>
                                </select>
                                @error('location_name')
                                    <div class="message text-red-700">{{ $message }}</div>
                                @enderror
                                <!-- Input ẩn để lưu mã và tên tỉnh -->
                                <input type="hidden" name="code" id="code_edit" value="{{ $location->code }}">
                                <input type="hidden" name="name" id="name_edit" value="{{ $location->name }}">
                            </div>
                            <div class="sm:col-span-2 form-group">
                                <label for="description"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.location.description') }}</label>
                                <textarea id="description" name="description"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Your description here">{{ $location->description }}</textarea>
                                @error('description')
                                    <div class="message text-red-700">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-2 border border-gray-300 rounded-lg p-4">
                                <label class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.location.select_characteristic') }}</label>
                                <div class="grid grid-cols-3 gap-4 form-group-characteristic">
                                    @foreach ($characteristics as $characteristic)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="characteristicsEdit[]" value="{{ $characteristic->id }}"
                                            {{ $location->characteristics->contains($characteristic->id) ? 'checked' : '' }} />
                                        <label class="ml-2">{{ $characteristic->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('characteristic_error')
                                <div class="message text-red-700">{{ $message }}</div>
                            @enderror

                            <div id="existingImages" class="flex flex-wrap gap-2 mt-4">
                                @foreach ($location->images as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image->image) }}"
                                            class="h-32 w-32 object-cover rounded-md shadow-sm border border-gray-300" />
                                        <button type="button" data-image-id="{{ $image->id }}"
                                            class="remove-image absolute top-2 right-2 text-red-600 bg-red-100 rounded-full w-8 h-8 flex items-center justify-center"> <i class="ri-close-line"></i></button>
                                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="sm:col-span-2 mt-4 form-group">
                                <label for="images_edit" class="text-base text-gray-500 font-semibold mb-2 block">Upload
                                    New Images</label>
                                <input type="file" id="images_edit" name="location_image[]" class="hidden" multiple
                                    accept="image/*" />
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
                                @error('images')
                                    <div class="message text-red-700">{{ $message }}</div>
                                @enderror
                                <div id="editpreview" class="flex flex-wrap gap-2 mt-2"></div>
                            </div>
                        </div>
                        <button type="submit" id="submit-edit-location"
                            class="py-2 px-4 rounded-lg bg-[#EDA315] hover:bg-[#316887] text-white mt-4 sm:mt-6 text-sm font-medium">
                            {{ __('content.location.edit') }}
                        </button>
                    </form>
            </div>
        </section>
    </div>
</dialog>
