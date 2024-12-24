<dialog id="modal_update_product" class="modal">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4">
        <button id="btn-close-modal" class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        <h2 class="mb-4 text-xl font-bold text-gray-900">   {{ __('content.convenient.edit_convenient') }}</h2>

        <section class="bg-white w-full flex justify-center min-w-[600px]">
            <div class="pt-4 pb-8 px-4 min-w-[60%]">

                <form id="form-edit-convenient"
                    action="{{ route('admin.convenients.update', ['id' => $convenient->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <input type="hidden" id="convenient-id" name="convenient_id" value="{{ $convenient->id }}">

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <div class="sm:col-span-2">
                                <label for="name"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.convenient.name') }}</label>
                                <input type="text" name="name" id="name" value="{{ $convenient->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                        </div>
                        @error('name')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <div class="sm:col-span-2">
                                <label for="icon_class"
                                    class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.convenient.icon') }}</label>
                                <input type="text" name="icon_class" id="icon_class" value="{{ $convenient->icon_class }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                        </div>
                        @error('icon_class')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror

                    </div>

                    <button type="submit" id="submit-edit-convenient"
                        class="py-2 px-4 rounded-lg bg-[#EDA315] hover:bg-[#316887] text-white mt-4 sm:mt-6 text-sm font-medium">
                        {{ __('content.characteristic.edit') }}
                    </button>
                </form>

            </div>
        </section>
    </div>
</dialog>
