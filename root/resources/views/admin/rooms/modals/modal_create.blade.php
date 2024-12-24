<dialog id='modal_create_rooms' class='modal'>
    <div class='modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4'>
        <button id='close_modal_button'
            class='btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3'><i class="ri-close-line text-2xl"></i></button>
        @isset($destination)
            @include('admin.rooms.partials.modal_content')
        @endisset
    </div>
</dialog>
