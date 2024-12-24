<dialog id="modal_add_product" class="modal">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        </form>
        <h2 class="mb-4 text-xl font-bold text-gray-900"> {{ __('content.convenient.add_convenient') }}
        </h2>

        <section class="bg-white w-full flex justify-center min-w-[600px]">
            <div class="pt-4 pb-8 px-4  min-w-[60%]">
                <!-- Form để nhập dữ liệu -->
                <form id="form-add-convenient" action="{{ route('admin.convenients.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.convenient.name') }}  <span style="color: red">*</span></label>
                            <input type="text" id="name" name="name"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
                        </div>
                        @error('name')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror

                        <div class="sm:col-span-2">
                            <label for="icon_class"
                                class="text-base text-gray-500 font-semibold mb-2 block">{{ __('content.convenient.icon') }}</label>
                            <input type="text" id="icon_class" name="icon_class" placeholder="e.g., fa-wifi"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300">
                        </div>
                        @error('icon_class')
                            <div class="message text-red-700">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="submit-all-convenients"
                        class="py-2 px-4 rounded-lg bg-[#316887] text-white mt-4">{{ __('content.convenient.add') }}</button>
                </form>
            </div>
        </section>
    </div>
</dialog>