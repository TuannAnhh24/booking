<dialog id="modal_delete_characteristic" class="modal rounded-[24px]">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-sm flex items-center mx-auto p-4  min-w-[400px]">
        <form method="dialog">
            <button type="button" class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        </form>
        <h2 class="mb-4 text-lg font-bold text-gray-900">{{ __('content.characteristic.deleted') }}</h2>
        <section class="bg-white w-[80%] flex justify-center">
            <div class="pt-2 pb-4 px-4">
                <form id="form-delete-characteristic" action="" method="POST">
                    @csrf
                    @method('GET')
                    <div class="grid gap-4 sm:grid-cols-1 sm:gap-4">
                        <div class="sm:col-span-1">
                            <label for="deleteReason" class="text-base text-gray-500 font-semibold mb-2 block">
                                {{ __('content.characteristic.deleted_reason') }}
                            </label>
                            <textarea id="deleteReason" name="deleted_reason"
                                class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500
                                placeholder="{{ __('content.characteristic.placeholder_del') }}"></textarea>
                        </div>
                        @error('deleted_reason')
                        <div class="message text-red-700">{{ $message }}</div>
                        @enderror

                    </div>
                    <button type="submit" id="submit_delete_characteristic"
                        class="py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent text-white text-sm mt-4 hover:bg-[#316887]">
                        {{ __('content.characteristic.remove') }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</dialog>