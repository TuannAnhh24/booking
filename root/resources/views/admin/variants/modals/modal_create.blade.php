<dialog id='modal_create_variant' class='modal'>
    <div class='modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4'>
        <button id='close_modal_button'
            class='btn btn-sm btn-circle btn-ghost text-black absolute right-2 top-2'>✕</button>
        <h2 class='mb-4 text-xl font-bold text-gray-900'>{{ __('content.variant.create_variant') }}</h2>
        <section class='bg-white w-full flex justify-center min-w-[600px]'>
            <div class='pt-4 pb-8 px-4  min-w-[60%]'>
                <form action='{{ route('admin.variants.store') }}' method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class='grid gap-4 sm:grid-cols-2 sm:gap-6'>
                        <div class='sm:col-span-2'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.variant.name') }}
                            </label>
                            <input type='text' id='name' name="name"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                placeholder='Type product name' />
                            @error('name')
                                <div class="error-message text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload files -->
                        <div class="sm:col-span-2">
                            <label for="images" class="text-base text-gray-500 font-semibold mb-2 block"> {{ __('content.variant.image_up') }}</label>
                            <input type="file" id="images" name="variant_image[]" class="hidden" multiple
                                accept="image/*" onchange="previewImages(event)" />
                            <label for="images"
                                class="bg-white sm:col-span-2 text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto font-[sans-serif]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500"
                                    viewBox="0 0 32 32">
                                    <path
                                        d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z" />
                                    <path
                                        d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z" />
                                </svg>
                                {{ __('content.variant.image_up') }}
                            </label>
                            <div id="preview" class="flex flex-wrap gap-2 mt-2"></div>
                            <p class="text-xs text-gray-400 mt-2">
                                {{ __('content.variant.image_detail') }}
                            </p>
                        </div>

                        <!-- Description -->
                        <div class='sm:col-span-2'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.variant.description') }}
                            </label>
                            <textarea id='description'
                                class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500'
                                placeholder='Your description here' name="description"></textarea>
                        </div>
                    </div>

                    <button type='submit'
                        class='py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent hover:text-white text-white text-md mr-4 hover:bg-[#316887] inline-flex items-center mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 focus:ring-4 focus:ring-primary-200 hover:bg-primary-800'>
                        {{ __('content.variant.add') }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</dialog>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        function validateRequired(value) {
            return value.trim() !== '';
        }

        const usernameInput = document.getElementById('name');
        addValidation(usernameInput, 'Tên biến thể không được để trống', validateRequired);
    })
</script>
@endpush