<dialog id="modal_update_product" class="modal">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto p-4 min-w-[850px]">
        <button type="button"
            class="btn btn-sm btn-circle btn-ghost text-black absolute btn-close-modal right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('content.category.update_category') }}
        </h2>

        @if (isset($category))
            <section class="bg-white w-full flex justify-center">
                <div class="pt-4 pb-8 px-4 mx-auto max-w-2xl min-w-[60%]">
                    <form id="form-update-category" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="update_name"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.category.category_name') }}</label>
                                <input type="text" id="update_name" name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Type category name" value="{{ old('name', $category->name) }}" />
                                    <span class="text-red-500 text-sm mt-2 error" id="error-name"></span>
                                @error('name')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="update_description"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.category.description') }}</label>
                                <textarea id="update_description" name="description"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                                    placeholder="Your description here">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="update_images"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.category.upload_images') }}</label>
                                <input type="file" id="update_images" name="images[]" class="hidden" multiple
                                    accept="image/*" onchange="previewEditImages(event)" />
                                <label for="update_images"
                                    class="bg-white sm:col-span-2 text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500"
                                        viewBox="0 0 32 32">
                                        <path
                                            d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" />
                                        <path
                                            d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" />
                                    </svg>
                                    {{ __('content.category.upload_images') }}
                                </label>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach ($category->images as $image)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                alt="Image of {{ $category->name }}"
                                                class="h-32 w-32 object-cover rounded-md shadow-sm border border-gray-300">
                                                <button type="button" class="absolute top-2 right-2 text-red-600 bg-red-100 rounded-full w-8 h-8 flex items-center justify-center"
                                                 onclick="removeImage({{ $image->id }})">
                                                 <i class="ri-close-line"></i></button>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" id="images_to_delete" name="images_to_delete" value="">
                                <div id="editpreview" class="flex flex-wrap gap-2 mt-2 edit"></div>
                                <p class="text-xs text-gray-400 mt-2"> {{ __('content.category.image_format') }}</p>
                                @error('images')
                                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent hover:text-white text-white text-md mr-4 hover:bg-[#316887] inline-flex items-center mt-4">
                            {{ __('content.category.update_category') }}
                        </button>
                    </form>
                </div>
            </section>
        @else
            <div class="text-red-500 text-lg">
                {{ __('content.category.category_not_found') }}
            </div>
        @endif
    </div>
</dialog>