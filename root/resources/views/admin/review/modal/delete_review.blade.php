<dialog id="modal_delete_review" class="modal rounded-[24px]">
    <div class="modal-box flex-col font-[sans-serif] bg-white max-w-sm flex items-center mx-auto p-4 min-w-[400px]">
        <form method="dialog">
            <button type="button" class="btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3"><i class="ri-close-line text-2xl"></i></button>
        </form>
        <h2 class="mb-4 text-lg font-bold text-gray-900">{{ __('content.review.confirm_delete') }}</h2>
        <section class="bg-white w-full flex justify-center min-w-[80%]">
            <div class="pt-2 pb-4 px-4">
                <form id="form-delete-review" action="" method="GET">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-1 sm:gap-4">
                        <div class="sm:col-span-1">
                            <label for="deleteReason" class="text-base text-gray-500 font-semibold mb-2 block">
                                {{ __('content.review.reason_for_deletion') }}
                            </label>
                            <textarea id="deletion_reason" name="deletion_reason"
                                class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="{{ __('content.review.reason_for_deletion') }}"></textarea>
                        </div>
                        @error('deletion_reason')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent text-white text-sm mt-4 hover:bg-[#316887]">
                        {{ __('content.review.delete') }}
                    </button>
                </form>
            </div>
        </section>
    </div>
</dialog>