<dialog id='modal_edit_variant' class='modal'>
    <div class='modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] md:h-screen p-4'>
        <button id='close_modal_button_edit'
            class='btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3'><i class="ri-close-line text-2xl"></i></button>
        <h2 class='mb-4 text-xl font-bold text-gray-900'>{{ __('content.variant.update_variant') }}</h2>
        @if (isset($variant))
            <section class='bg-white w-full flex justify-center min-w-[600px]'>
                <div class='pt-4 pb-8 px-4 min-w-[60%]'>
                    <form action='{{ route('admin.variants.update', ['id' => $variant->id]) }}' method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type='hidden' name='id' id='variant_id' value="{{ $variant->id }}" />
                        <!-- Tên variant -->
                        <div class='sm:col-span-2'>
                            <label
                                class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.variant.name') }}</label>
                            <input type='text' id='name'  name="name" value="{{ optional($variant)->name }}"
                                class='nameVari bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                placeholder='Type product name' />
                            @error('name')
                                <div class="edit-error-message message text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mô tả sản phẩm -->
                        <div class='sm:col-span-2 mt-4'>
                            <label
                                class='text-base text-gray-500 font-semibold mb-2 block'>{{ __('content.variant.description') }}</label>
                            <textarea id='description_edit'
                                class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500'
                                placeholder='Your description here' name="description">{{ optional($variant)->description }}</textarea>
                        </div>

                        <!-- Hiển thị ảnh hiện có nếu có biến thể -->

                        <div id="existingImages" class="flex flex-wrap gap-2 mt-4">
                            @foreach (optional($variant)->images as $image)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $image->image) }}"
                                        class="h-32 w-32 object-cover rounded-md shadow-sm border border-gray-300" />
                                    <button type="button" data-image-id="{{ $image->id }}"
                                        class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 remove-image">✕</button>
                                    <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                </div>
                            @endforeach
                        </div>


                        <!-- Chọn ảnh mới để thay thế -->
                        <div class="sm:col-span-2 mt-4">
                            <label for="images_edit"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.variant.image_up_new') }}</label>
                            <input type="file" id="images_edit" name="variant_image[]" class="hidden" multiple
                                accept="image/*" onchange="previewImagesEdit(event)" />

                            <label for="images_edit"
                                class="bg-white text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500"
                                    viewBox="0 0 32 32">
                                    <path
                                        d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" />
                                    <path
                                        d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" />
                                </svg>
                                {{ __('content.variant.image_up_new') }}
                            </label>

                            <div id="previewEdit" class="flex flex-wrap gap-2 mt-2"></div>
                        </div>

                        <!-- Nút lưu thay đổi -->
                        <button type='submit'
                            class='py-2 px-4 rounded-lg bg-[#EDA315] hover:bg-[#316887] text-white mt-4 sm:mt-6 text-sm font-medium'>{{ __('content.variant.edit') }}</button>
                    </form>
                </div>
            </section>
        @endif
    </div>
</dialog>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        function validateRequiredUpdateVari(value) {
            return value.trim() !== '';
        }

        const nameInputVari = document.getElementById('name');
        addValidation(nameInputVari, 'Tên biến thể không được để trống', validateRequiredUpdateVari);
    })
</script>
@endpush
