@extends('admin.layouts.master-layout')
@section('content')
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
            <div class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class='flex items-center justify-between gap-8 mb-8'>
                        <div>
                            <h5
                                class='block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900'>
                                {{ __('content.room.room_list') }}
                            </h5>
                        </div>

                        <div class='flex flex-col gap-2 shrink-0 sm:flex-row'>
                            <div class='w-full md:w-72'>
                                <div class='relative h-10 w-full min-w-[200px]'>
                                    <div
                                        class='absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500'>
                                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'
                                            strokeWidth='1.5' stroke='currentColor' aria-hidden='true' class='w-5 h-5'>
                                            <path strokeLinecap='round' strokeLinejoin='round'
                                                d='M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z'>
                                            </path>
                                        </svg>
                                    </div>
                                    <input
                                        class='peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50'
                                        placeholder='' />
                                    <label
                                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                        {{ __('content.user.search') }}
                                    </label>
                                </div>
                            </div>

                            <div class="dropdown">
                                <button type="button"
                                    class="dropdown-toggle select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"><i
                                        class="ri-more-2-fill"></i></button>
                                <ul
                                    class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                    <li>
                                        <a href="{{ route('admin.rooms.trash') }}"
                                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"><i
                                                class="ri-delete-bin-line text-xl"></i>
                                            {{ __('content.room.trash') }}</a>
                                    </li>
                                </ul>
                                </button>
                            </div>

                            <button
                                class='flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                type='button' id='open_modal_button'>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                                    aria-hidden='true' strokeWidth='2' class='w-4 h-4'>
                                    <path
                                        d='M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z'>
                                    </path>
                                </svg>
                                {{ __('content.user.add_user') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.id') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.name') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.destination') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.quantity') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.guest_quantity') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.price') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.room_image') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.room.description') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.room.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr class="text-gray-700">
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        {{ $room->id }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $room->name }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">

                                        {{ $room->destinations->name }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $room->roomLists->count() }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $room->guest_quantity }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($room->variants->isNotEmpty() && $room->variants->first()->pivot)
                                            {{ $room->variants->first()->pivot->price_per_night }}
                                        @else
                                            <span class="text-gray-500">No price available</span>
                                        @endif
                                    </td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($room->images->isNotEmpty())
                                            @php
                                                $image = $room->images->first();
                                            @endphp
                                            <button class="open-modal-btn" data-id="{{ $room->id }}">
                                                <img src="{{ asset('storage/' . $image->image) }}" alt=""
                                                    class="h-24 w-24 object-cover rounded-md shadow-sm border border-gray-300">
                                            </button>
                                        @else
                                            <p>{{ __('content.room.no_image') }}</p>
                                        @endif
                                    </td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 overflow-hidden text-ellipsis max-w-[50px]">
                                        {{ $room->description }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <button
                                            class='edit-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type='button' title='Edit' data-id='{{ $room->id }}'>
                                            <i class="ri-pencil-line text-xl"></i>
                                        </button>
                                        <button
                                            class='delete-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-red-500 transition-all hover:bg-red-500/10 active:bg-red-500/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type='button' title='Delete' data-id='{{ $room->id }}'>
                                            <i class="ri-delete-bin-line text-xl"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Hiển thị phân trang -->
                    <div class="mt-4">
                        {{ $rooms->links('admin.layouts.pagination') }}
                    </div>
                </div>

                @include('admin.rooms.modals.modal_create')
                @include('admin.rooms.modals.modal_image')

                @isset($room)
                    @include('admin.rooms.modals.modal_delete')
                    @include('admin.rooms.modals.modal_edit')
                @endisset


            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal_create_rooms');
            const openModalButton = document.getElementById('open_modal_button');
            let selectedFiles = []; // Mảng lưu trữ các ảnh đã chọn

            // Mở modal khi nhấn nút thêm
            openModalButton.addEventListener('click', function() {
                fetchDataAndShowModal();
            });

            function fetchDataAndShowModal() {
                fetch(`/admin/rooms/create`)
                    .then(response => response.text())
                    .then(html => {
                        modal.querySelector('.modal-box').innerHTML = html;
                        modal.showModal();

                        attachCloseModalHandler();
                        attachPreviewHandler();
                        attachFormSubmitHandler();
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }

            function attachCloseModalHandler() {
                const closeModalButton = document.getElementById('close_modal_button');
                if (closeModalButton) {
                    closeModalButton.addEventListener('click', function() {
                        modal.close();
                    });
                }
            }

            function attachPreviewHandler() {
                const imageInput = document.getElementById('images');
                if (imageInput) {
                    imageInput.addEventListener('change', previewImages);
                }
            }

            function previewImages(event) {
                const files = Array.from(event.target.files);
                selectedFiles = [];
                files.forEach(file => {
                    if (!selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                        selectedFiles.push(file);
                    }
                });
                renderPreview();
            }

            function renderPreview() {
                const preview = document.getElementById('preview');
                preview.innerHTML = '';
                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageContainer = document.createElement('div');
                        imageContainer.classList.add('relative');
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm',
                            'border', 'border-gray-300');
                        const removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500',
                            'text-white', 'rounded-full', 'p-1');
                        removeButton.textContent = '✕';
                        removeButton.addEventListener('click', function() {
                            selectedFiles.splice(index, 1);
                            renderPreview();
                        });
                        imageContainer.appendChild(img);
                        imageContainer.appendChild(removeButton);
                        preview.appendChild(imageContainer);
                    };
                    reader.readAsDataURL(file);
                });
            }

            function attachFormSubmitHandler() {
                const form = modal.querySelector('form');
                const submitButton = form.querySelector('[type="submit"]');
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitButton.disabled = true;
                    submitButton.textContent = '{{ __('content.room.processing') }}';
                    let formData = new FormData(this);
                    const uniqueFiles = selectedFiles.filter((file, index, self) =>
                        index === self.findIndex(f => f.name === file.name && f.size === file.size)
                    );
                    formData.delete('room_image[]');
                    uniqueFiles.forEach(file => {
                        formData.append('room_image[]', file);
                    });
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function() {
                            location.reload();
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON.errors;
                            $('.error-message').remove();
                            $.each(errors, function(key, value) {
                                $(`#${key}`).after(
                                    '<div class="error-message text-red-500">' +
                                    value[0] + '</div>'
                                );
                            });
                            submitButton.disabled = false;
                            submitButton.textContent = '{{ __('content.room.submit') }}';
                        }
                    });
                });
            }


            // Xử lý modal xóa
            const modalDelete = document.getElementById('modal_delete_rooms');
            const openModalButtonsDelete = document.querySelectorAll('.delete-button'); // Lấy tất cả nút xóa
            const closeModalButtonDelete = document.getElementById('close_modal_button_delete');
            const formDelete = modalDelete.querySelector('form'); // Form xóa
            const submitButtonDelete = formDelete.querySelector('[type="submit"]'); // Nút submit xóa

            openModalButtonsDelete.forEach(button => {
                button.addEventListener('click', function() {
                    const roomId = this.getAttribute('data-id'); // Lấy ID room cần xóa
                    formDelete.querySelector('input[name="id"]').value = roomId; // Gắn ID vào form
                    formDelete.setAttribute('action', `/admin/rooms/delete/${roomId}`);
                    modalDelete.showModal(); // Hiển thị modal
                });
            });

            closeModalButtonDelete.addEventListener('click', function() {
                modalDelete.close();
            });

            formDelete.addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear any existing error message to prevent duplication
                $('.error-message').remove();

                let reason = document.getElementById('reason_delete').value.trim();
                if (!reason) {
                    $('#reason_delete').after(
                        '<div class="error-message text-red-500">Reason is required.</div>'
                    );
                    return; // Stop form submission if reason is empty
                }

                submitButtonDelete.disabled = true;
                submitButtonDelete.textContent = '{{ __('content.room.deleting') }}';

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log full response for debugging
                        let errors = xhr.responseJSON.errors || {};

                        // Remove any existing error message before adding a new one
                        $('#reason_delete').next('.error-message').remove();

                        // Add error message if there is an error with the 'reason' field
                        if (errors.reason) {
                            $('#reason_delete').after(
                                `<div class="error-message text-red-500">${errors.reason[0]}</div>`
                            );
                        }

                        // Re-enable the submit button and reset the text
                        submitButtonDelete.disabled = false;
                        submitButtonDelete.textContent = '{{ __('content.room.delete') }}';
                    }
                });
            });


        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtonsEdit = document.querySelectorAll('.edit-button');

            openModalButtonsEdit.forEach(button => {
                button.addEventListener('click', function() {
                    const roomId = this.getAttribute('data-id');


                    // Fetch modal content dynamically from server (HTML response)
                    fetch(`/admin/rooms/${roomId}/edit`)
                        .then(response => response.text())
                        .then(html => {
                            let existingModal = document.getElementById('modal_edit_rooms');

                            // Close and remove existing modal if open
                            if (existingModal) {
                                existingModal.close();
                                existingModal.remove();
                            }

                            // Insert new modal content into DOM
                            document.body.insertAdjacentHTML('beforeend', html);

                            const modalEdit = document.getElementById('modal_edit_rooms');
                            modalEdit.showModal();

                            // Handle closing modal
                            const closeModalButton = modalEdit.querySelector(
                                '#close_modal_button_edit');
                            closeModalButton.addEventListener('click', function() {
                                modalEdit.close();
                            });

                            // Handle click outside to close modal
                            modalEdit.addEventListener('click', function(event) {
                                if (event.target === modalEdit) {
                                    modalEdit.close();
                                }
                            });

                            // Handle image previews and file selection
                            let oldImages = Array.from(modalEdit.querySelectorAll('.old-image'))
                                .map(img => img.src);
                            let selectedNewFiles = [];

                            const imageInputEdit = document.getElementById('images_edit');
                            const newImageInputClone = imageInputEdit.cloneNode(
                                true); // Clone to remove existing events
                            imageInputEdit.parentNode.replaceChild(newImageInputClone,
                                imageInputEdit);

                            newImageInputClone.addEventListener('change', function(event) {
                                previewImagesEdit(event, oldImages, selectedNewFiles);
                            });

                            const existingImagesContainer = document.getElementById(
                                'existingImages');
                            existingImagesContainer.addEventListener('click', function(event) {
                                if (event.target.classList.contains('remove-image')) {
                                    const imageId = event.target.getAttribute(
                                        'data-image-id');
                                    removeOldImage(imageId);
                                }
                            });

                            function removeOldImage(imageId) {
                                const imageElement = document.querySelector(
                                    `button[data-image-id='${imageId}']`).closest(
                                    '.relative');
                                if (imageElement) {
                                    imageElement.remove(); // Remove image from DOM
                                }
                            }

                            function renderPreviewEdit() {
                                const previewEdit = document.getElementById('previewEdit');
                                previewEdit.innerHTML = ''; // Clear preview before rendering

                                // Render old images
                                oldImages.forEach(src => {
                                    const imageContainer = document.createElement(
                                        'div');
                                    imageContainer.classList.add('relative');

                                    const img = document.createElement('img');
                                    img.src = src;
                                    img.classList.add('h-32', 'w-32', 'object-cover',
                                        'rounded-md', 'shadow-sm', 'border',
                                        'border-gray-300');

                                    const removeButtonOld = document.createElement(
                                        'button');
                                    removeButtonOld.type = 'button';
                                    removeButtonOld.classList.add('absolute', 'top-0',
                                        'right-0',
                                        'bg-red-500', 'text-white', 'rounded-full',
                                        'p-1');
                                    removeButtonOld.textContent = '✕';

                                    removeButtonOld.addEventListener('click',
                                        function() {
                                            const index = oldImages.indexOf(src);
                                            if (index > -1) {
                                                oldImages.splice(index,
                                                    1); // Remove image from array
                                                renderPreviewEdit
                                                    (); // Re-render preview
                                            }
                                        });

                                    imageContainer.appendChild(img);
                                    imageContainer.appendChild(removeButtonOld);
                                    previewEdit.appendChild(imageContainer);
                                });

                                // Render new images
                                selectedNewFiles.forEach((file, index) => {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const imageContainer = document
                                            .createElement('div');
                                        imageContainer.classList.add('relative');

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.classList.add('h-32', 'w-32',
                                            'object-cover', 'rounded-md',
                                            'shadow-sm', 'border',
                                            'border-gray-300');

                                        const removeButtonNew = document
                                            .createElement('button');
                                        removeButtonNew.type = 'button';
                                        removeButtonNew.classList.add('absolute',
                                            'top-0', 'right-0',
                                            'bg-red-500', 'text-white',
                                            'rounded-full', 'p-1');
                                        removeButtonNew.textContent = '✕';

                                        removeButtonNew.addEventListener('click',
                                            function() {
                                                selectedNewFiles.splice(index,
                                                    1
                                                ); // Remove file from array
                                                renderPreviewEdit
                                                    (); // Re-render preview
                                            });

                                        imageContainer.appendChild(img);
                                        imageContainer.appendChild(removeButtonNew);
                                        previewEdit.appendChild(imageContainer);
                                    };
                                    reader.readAsDataURL(file);
                                });
                            }

                            function previewImagesEdit(event) {
                                const files = Array.from(event.target.files);
                                files.forEach(file => {
                                    if (!selectedNewFiles.some(f => f.name === file
                                            .name && f.size === file.size)) {
                                        selectedNewFiles.push(file);
                                    }
                                });
                                renderPreviewEdit(); // Update preview
                            }

                            // Handle form submission
                            const formEdit = modalEdit.querySelector('form');
                            formEdit.addEventListener('submit', function(e) {
                                e.preventDefault(); // Prevent default form submit

                                let formData = new FormData(
                                    this); // Create FormData object from form

                                const uniqueNewFiles = selectedNewFiles.filter((file,
                                        index, self) =>
                                    index === self.findIndex(f => f.name === file
                                        .name && f.size === file.size)
                                );

                                formData.delete(
                                    'room_image[]'); // Remove previously added files
                                uniqueNewFiles.forEach(file => {
                                    formData.append('room_image[]',
                                        file); // Append unique files
                                });

                                $.ajax({
                                    url: $(this).attr(
                                        'action'), // Use form action URL
                                    method: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        location
                                            .reload(); // Reload page on success
                                    },
                                    error: function(xhr) {
                                        let editErrors = xhr.responseJSON
                                            .errors; // Get errors from response
                                        $('#modal_edit_rooms .error-message')
                                            .remove(); // Remove previous errors

                                        // Display errors below input fields
                                        $.each(editErrors, function(key,
                                            value) {
                                            $(`#modal_edit_rooms #${key}`)
                                                .after(
                                                    '<div class="edit-error-message text-red-500">' +
                                                    value[0] +
                                                    '</div>'
                                                );
                                        });
                                    }
                                });
                            });
                        })
                        .catch(error => {
                            console.error('Error loading modal content:', error);
                        });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mở modal
            const openModalBtns = document.querySelectorAll('.open-modal-btn');
            openModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const roomId = btn.dataset.id;
                    const modal = document.getElementById(`modal-${roomId}`);
                    modal.classList.remove('hidden');

                    // Gắn sự kiện click vào ảnh trong modal
                    const modalImages = modal.querySelectorAll('.modal-image');
                    modalImages.forEach((img, index) => {
                        img.addEventListener('click', () => {
                            openImageViewer(img, modalImages, index);
                        });
                    });
                });
            });

            // Đóng modal
            const closeModalBtns = document.querySelectorAll('.close-modal-btn');
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('.modal');
                    modal.classList.add('hidden');
                });
            });

            // Hàm mở ảnh toàn màn hình
            function openImageViewer(img, images, startIndex) {
                let currentIndex = startIndex;

                // Tạo overlay để hiển thị ảnh lớn
                const overlay = document.createElement('div');
                overlay.classList.add('fixed', 'top-0', 'left-0', 'w-full', 'h-full', 'flex',
                    'items-center', 'justify-center', 'bg-black', 'bg-opacity-80', 'z-50');

                // Tạo ảnh lớn
                const largeImage = document.createElement('img');
                largeImage.src = images[currentIndex].src;
                largeImage.classList.add('max-w-[90%]', 'max-h-[90%]', 'object-contain');

                // Thêm ảnh vào overlay
                overlay.appendChild(largeImage);

                // Tạo nút Previous
                const prevButton = document.createElement('button');
                prevButton.innerHTML = '❮';
                prevButton.classList.add('absolute', 'left-4', 'text-white', 'text-3xl',
                    'font-bold', 'bg-black', 'bg-opacity-50', 'rounded-full', 'p-2');
                prevButton.addEventListener('click', (e) => {
                    e.stopPropagation(); // Ngăn overlay bị đóng
                    currentIndex = (currentIndex - 1 + images.length) % images.length; // Lùi về ảnh trước
                    largeImage.src = images[currentIndex].src;
                });

                // Tạo nút Next
                const nextButton = document.createElement('button');
                nextButton.innerHTML = '❯';
                nextButton.classList.add('absolute', 'right-4', 'text-white', 'text-3xl',
                    'font-bold', 'bg-black', 'bg-opacity-50', 'rounded-full', 'p-2');
                nextButton.addEventListener('click', (e) => {
                    e.stopPropagation(); // Ngăn overlay bị đóng
                    currentIndex = (currentIndex + 1) % images.length; // Tiến tới ảnh tiếp theo
                    largeImage.src = images[currentIndex].src;
                });

                // Thêm nút và overlay vào DOM
                overlay.appendChild(prevButton);
                overlay.appendChild(nextButton);
                document.body.appendChild(overlay);

                // Đóng overlay khi click bên ngoài ảnh
                overlay.addEventListener('click', () => {
                    overlay.remove();
                });
            }
        });
    </script>
@endpush






@push('style')
    <style>
        /* Tùy chỉnh scrollbar cho modal */
        #modal_create_rooms,
        #modal_edit_rooms {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_create_rooms::-webkit-scrollbar,
        #modal_edit_rooms::-webkit-scrollbar {
            width: 8px;
        }

        #modal_create_rooms::-webkit-scrollbar-thumb,
        #modal_edit_rooms::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.3);
            /* Đậm màu hơn */
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_create_rooms,
        #modal_edit_rooms {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.3) transparent;
            /* Tương thích Firefox */
        }

        /* Căn chỉnh checkbox thành lưới */
        .checkbox-grid,
        #checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            /* Tự động chia cột, đảm bảo tối thiểu 150px cho mỗi mục */
            gap: 12px;
            /* Khoảng cách giữa các checkbox */
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            /* Khoảng cách giữa checkbox và text */
            font-size: 14px;
            /* Chỉnh kích thước text */
        }

        /* Tăng tính thẩm mỹ cho checkbox */
        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border: 2px solid #ccc;
            border-radius: 4px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .checkbox-item input[type="checkbox"]:checked {
            background-color: #4CAF50;
            /* Màu xanh khi chọn */
            border-color: #4CAF50;
        }

        /* Tăng hiệu ứng hover */
        .checkbox-item:hover {
            background-color: #f9f9f9;
            border-radius: 4px;
            padding: 4px;
        }

        //
    </style>
@endpush
