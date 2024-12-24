<dialog id='modal_delete_rooms' class='modal rounded-[24px]'>
    <div class='modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[400px] p-4'>
        <button id='close_modal_button_delete'
            class='btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3'><i class="ri-close-line text-2xl"></i></button>
        <h2 class='mb-4 text-xl font-bold text-gray-900'>{{ __('content.room.delete_room') }}</h2>
        <section class='bg-white w-full flex justify-center w-[80%]'>
            <div class='pt-4 pb-8 px-4'>
                <form action='{{ route('admin.rooms.delete', ['id' => optional($room)->id]) }}' method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ optional($room)->id }}" />
                    <div class='grid gap-4 sm:grid-cols-2 sm:gap-6'>
                        <div class='sm:col-span-2'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.room.reason') }}
                            </label>
                            <textarea id='reason_delete'
                                class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500'
                                placeholder='Your reason here' name="reason"></textarea>
                            @error('reason')
                                <div class="error-message text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type='submit'
                        class='py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent hover:text-white text-white text-md mr-4 hover:bg-[#316887] inline-flex items-center mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700 focus:ring-4 focus:ring-primary-200 hover:bg-primary-800'>
                        {{ __('content.room.delete') }}
                    </button>
                </form>

            </div>
        </section>
    </div>
</dialog>
