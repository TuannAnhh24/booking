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
                                {{ __('content.variant.variant_list') }}
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
                                    <form id="searchForm" method="GET" action="{{ route('admin.variants.index') }}">
                                        <input id="search" name="keyword"
                                            class='peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50'
                                            placeholder='' />
                                        <label
                                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all">
                                            {{ __('content.variant.search') }}
                                        </label>
                                    </form>
                                </div>
                            </div>

                            <div class="dropdown">
                                <button type="button"
                                    class="dropdown-toggle select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"><i
                                        class="ri-more-2-fill"></i></button>
                                <ul
                                    class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                                    <li>
                                        <a href="{{ route('admin.variants.trash') }}"
                                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"><i
                                                class="ri-delete-bin-line text-xl"></i>
                                            {{ __('content.variant.trash') }}</a>
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
                                    class="px-4 bg-gray-100 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.variant.name') }}</th>
                                <th
                                    class="px-4 bg-gray-100 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.variant.variant_image') }}</th>
                                <th
                                    class="px-4 bg-gray-100 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.variant.description') }}</th>
                                <th
                                    class="px-4 bg-gray-100 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.variant.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="variant-list">
                            @include('admin.variants.partials.table')
                        </tbody>
                    </table>

                    <!-- Hiển thị phân trang -->
                    <div class="mt-4">
                        {{ $variants->links('admin.layouts.pagination') }}
                    </div>
                </div>
                @include('admin.variants.modals.modal_create')
                @include('admin.variants.modals.modal_delete')
                @include('admin.variants.modals.modal_image')
                @isset($variant)
                    @include('admin.variants.modals.modal_edit')
                @endisset
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
            function addValidation(inputElement, errorMessage, validateFn) {
            console.log("vào đây chưa")
            if (!inputElement || typeof validateFn !== 'function') {
                console.error("Invalid input element or validation function.");
                return;
            }

            let errorElement = inputElement.parentNode.querySelector('.update-error');
            if (errorElement) {
                errorElement.remove();
            }
            
            const errorSpan = document.createElement('span');
            errorSpan.classList.add('update-error','text-red-500', 'text-sm', 'hidden');
            errorSpan.textContent = errorMessage;
            inputElement.parentNode.insertBefore(errorSpan, inputElement.nextSibling);
        
            const showError = () => {
                if (!validateFn(inputElement.value)) {
                    errorSpan.classList.remove('hidden');
                } else {
                    errorSpan.classList.add('hidden');
                }
            };

            inputElement.addEventListener('blur', showError);
            inputElement.addEventListener('input', showError);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal_create_variant');
            const openModalButton = document.getElementById('open_modal_button');
            const closeModalButton = document.getElementById('close_modal_button');
            const form = modal.querySelector('form');
            let isSubmitting = false;

            openModalButton.addEventListener('click', function() {
                modal.showModal();
            });

            closeModalButton.addEventListener('click', function() {
                modal.close();
            });

            let selectedFiles = [];

            function previewImages(event) {
                const files = Array.from(event.target.files);
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

            const imageInput = document.getElementById('images');
            imageInput.addEventListener('change', previewImages);

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                $(".update-error").remove();
                $(".message").remove();
                if (isSubmitting) return;
                isSubmitting = true;

                const submitButton = form.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.textContent = '{{ __('content.variant.processing') }}';

                let formData = new FormData(this);
                const uniqueFiles = selectedFiles.filter((file, index, self) =>
                    index === self.findIndex(f => f.name === file.name && f.size === file.size)
                );

                formData.delete('variant_image[]');
                uniqueFiles.forEach(file => {
                    formData.append('variant_image[]', file);
                });

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        isSubmitting = false;
                        location.reload();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors || {};
                        $('.error-message').remove();
                        $.each(errors, function(key, value) {
                            $('#' + key).after(
                                '<div class="error-message text-red-500">' + value[
                                    0] + '</div>');
                        });
                        isSubmitting = false;
                        submitButton.disabled = false;
                        submitButton.textContent = '{{ __('content.variant.submit') }}';
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const modalDelete = document.getElementById('modal_delete_variant');
            const openModalButtonsDelete = document.querySelectorAll('.delete-button');
            const closeModalButtonDelete = document.getElementById('close_modal_button_delete');
            const formDelete = document.getElementById('form_delete_variant');

            openModalButtonsDelete.forEach(button => {
                button.addEventListener('click', function() {
                    const variantId = this.getAttribute('data-id');
                    formDelete.action = `/admin/variants/delete/${variantId}`;
                    modalDelete.showModal();
                });
            });

            formDelete.addEventListener('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                const submitButton = formDelete.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.textContent = '{{ __('content.variant.processing') }}';
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        modalDelete.close(); // Đóng modal xóa
                        location.reload(); // Reload lại trang
                    },
                    error: function(xhr) {
                        console.error("Xóa thất bại:", xhr);
                        let errors = xhr.responseJSON.errors || {};
                        $('.delete-error-message').remove();
                        $.each(errors, function(key, value) {
                            const inputField = formDelete.querySelector(
                                `textarea[name="${key}"]`);
                            if (inputField) {
                                $(inputField).after(
                                    '<div class="delete-error-message text-red-500">' +
                                    value[0] + '</div>'
                                );
                            } else {
                                $('.modal-box').prepend(
                                    '<div class="delete-error-message text-red-500">' +
                                    value[0] + '</div>'
                                );
                            }
                            submitButton.disabled = false;
                            submitButton.textContent =
                                '{{ __('content.variant.submit') }}';
                        });
                    }
                });
            });


            closeModalButtonDelete.addEventListener('click', function() {
                modalDelete.close();
            });

            modalDelete.addEventListener('click', function(event) {
                if (event.target === modalDelete) {
                    modalDelete.close();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtonsEdit = document.querySelectorAll('.edit-button');
            openModalButtonsEdit.forEach(button => {
                button.addEventListener('click', function() {
                    const variantId = this.getAttribute('data-id');
                    // Fetch modal content dynamically
                    fetch(`/admin/variants/${variantId}/edit`)
                        .then(response => response.text())
                        .then(html => {
                            let existingModal = document.getElementById('modal_edit_variant');

                            // Close existing modal if open
                            if (existingModal) {
                                existingModal.close();
                                existingModal.remove();
                            }

                            // Insert new modal content into DOM
                            document.body.insertAdjacentHTML('beforeend', html);

                            // Now bind all required event listeners after modal is inserted
                            const modalEdit = document.getElementById('modal_edit_variant');
                            modalEdit.showModal();

                            // Close modal event
                            const closeModalButtonEdit = document.getElementById(
                                'close_modal_button_edit');
                            closeModalButtonEdit.addEventListener('click', function() {
                                modalEdit.close();
                            });

                            // Handling old images and new image uploads
                            const oldImages = Array.from(modalEdit.querySelectorAll(
                                '.old-image')).map(img => img.src);
                            let selectedNewFiles = []; // Store newly selected images

                            // Preview for new images
                            const imageInputEdit = document.getElementById('images_edit');
                            imageInputEdit.addEventListener('change', function(event) {
                                previewImagesEdit(event);
                            });

                            // Event delegation for remove old images
                            const existingImagesContainer = document.getElementById(
                                'existingImages');
                            existingImagesContainer.addEventListener('click', function(event) {
                                if (event.target.classList.contains('remove-image')) {
                                    const imageId = event.target.getAttribute(
                                        'data-image-id');
                                    removeOldImage(imageId);
                                }
                            });

                            // Function to remove old image
                            function removeOldImage(imageId) {
                                const imageElement = document.querySelector(
                                    `button[data-image-id='${imageId}']`).closest(
                                    '.relative');
                                if (imageElement) {
                                    imageElement.remove(); // Remove image from DOM
                                }
                            }

                            // Render preview for both old and new images
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
                                        'right-0', 'bg-red-500', 'text-white',
                                        'rounded-full', 'p-1');
                                    removeButtonOld.textContent = '✕';

                                    // Remove old image on click
                                    removeButtonOld.addEventListener('click',
                                        function() {
                                            const index = oldImages.indexOf(src);
                                            if (index > -1) {
                                                oldImages.splice(index,
                                                    1
                                                ); // Remove image from oldImages array
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
                                            'top-0', 'right-0', 'bg-red-500',
                                            'text-white', 'rounded-full', 'p-1');
                                        removeButtonNew.textContent = '✕';

                                        // Remove new image on click
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

                            // Preview new images function
                            function previewImagesEdit(event) {
                                const files = Array.from(event.target
                                    .files); // Get files from input

                                files.forEach(file => {
                                    if (!selectedNewFiles.some(f => f.name === file
                                            .name && f.size === file.size)) {
                                        selectedNewFiles.push(
                                            file); // Add file if not already present
                                    }
                                });

                                renderPreviewEdit(); // Update preview
                            }

                                // Handle form submit
                                const formEdit = modalEdit.querySelector('form');
                                formEdit.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    $(".message").remove()
                                    $(".update-error").remove()

                                    const uniqueNewFiles = selectedNewFiles.filter((file,
                                            index, self) =>
                                    index === self.findIndex(f => f.name === file
                                        .name && f.size === file.size)
                                    );
                                    const submitButton = formEdit.querySelector(
                                        'button[type="submit"]');
                                    submitButton.disabled = true;
                                    submitButton.textContent = 'Đang gửi...';

                                    let formData = new FormData(this);
                                    formData.delete('variant_image[]');
                                    selectedNewFiles.forEach(file => {
                                        formData.append('variant_image[]',
                                        file);
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
                                        $('#modal_edit_variant .edit-error-message')
                                            .remove(); // Remove previous errors

                                        // Display errors below input fields
                                        $.each(editErrors, function(key,
                                            value) {
                                            $(`#modal_edit_variant #${key}`)
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
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        });

        //Ajax tìm kiếm
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm debounce để giảm số lượng tìm kiếm
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this,
                        args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            // Hàm gắn các sự kiện modal xóa và sửa sau khi nội dung được cập nhật
            function attachModalEvents() {
                // Xử lý sự kiện mở modal xóa
                const modalDelete = document.getElementById('modal_delete_variant');
                const openModalButtonsDelete = document.querySelectorAll('.delete-button');
                const closeModalButtonDelete = document.getElementById('close_modal_button_delete');
                const formDelete = document.getElementById('form_delete_variant');

                // Mở modal khi nhấn nút
                openModalButtonsDelete.forEach(button => {
                    button.addEventListener('click', function() {
                        const variantId = this.getAttribute('data-id');
                        formDelete.action = `/admin/variants/delete/${variantId}`;
                        modalDelete.showModal(); // Hiển thị modal
                    });
                });

                // Đóng modal xóa khi nhấn nút đóng
                closeModalButtonDelete.addEventListener('click', function() {
                    modalDelete.close();
                });

                // Xử lý modal sửa
                const openModalButtonsEdit = document.querySelectorAll('.edit-button');
                openModalButtonsEdit.forEach(button => {
                    button.addEventListener('click', function() {
                        const variantId = this.getAttribute('data-id');
                        fetch(`/admin/variants/${variantId}/edit`)
                            .then(response => response.text())
                            .then(html => {
                                let existingModal = document.getElementById(
                                    'modal_edit_variant');

                                if (existingModal) {
                                    existingModal.close();
                                    existingModal.remove();
                                }

                                // Thêm nội dung modal mới vào DOM
                                document.body.insertAdjacentHTML('beforeend', html);

                                const modalEdit = document.getElementById('modal_edit_variant');
                                modalEdit.showModal();

                                // Gắn lại sự kiện đóng modal
                                const closeModalButtonEdit = document.getElementById(
                                    'close_modal_button_edit');
                                closeModalButtonEdit.addEventListener('click', function() {
                                    modalEdit.close();
                                });

                                // Xử lý xem trước và xóa hình ảnh
                                handleImagePreviewAndRemove(modalEdit);
                            })
                            .catch(error => console.error('Lỗi:', error));
                    });
                });
            }

            // Hàm xử lý hình ảnh xem trước và xóa hình ảnh trong modal sửa
            function handleImagePreviewAndRemove(modalEdit) {
                const oldImages = Array.from(modalEdit.querySelectorAll('.old-image')).map(img => img.src);
                let selectedNewFiles = []; // Store newly selected images

                // Preview for new images
                const imageInputEdit = document.getElementById('images_edit');
                imageInputEdit.addEventListener('change', function(event) {
                    previewImagesEdit(event);
                });

                // Event delegation for remove old images
                const existingImagesContainer = document.getElementById('existingImages');
                existingImagesContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-image')) {
                        const imageId = event.target.getAttribute('data-image-id');
                        removeOldImage(imageId);
                    }
                });

                // Function to remove old image
                function removeOldImage(imageId) {
                    const imageElement = document.querySelector(`button[data-image-id='${imageId}']`).closest(
                        '.relative');
                    if (imageElement) {
                        imageElement.remove(); // Remove image from DOM
                    }
                }

                // Render preview for both old and new images
                function renderPreviewEdit() {
                    const previewEdit = document.getElementById('previewEdit');
                    previewEdit.innerHTML = ''; // Clear preview before rendering

                    // Render old images
                    oldImages.forEach(src => {
                        const imageContainer = document.createElement('div');
                        imageContainer.classList.add('relative');

                        const img = document.createElement('img');
                        img.src = src;
                        img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm',
                            'border', 'border-gray-300');

                        const removeButtonOld = document.createElement('button');
                        removeButtonOld.type = 'button';
                        removeButtonOld.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500',
                            'text-white', 'rounded-full', 'p-1');
                        removeButtonOld.textContent = '✕';

                        // Remove old image on click
                        removeButtonOld.addEventListener('click', function() {
                            const index = oldImages.indexOf(src);
                            if (index > -1) {
                                oldImages.splice(index, 1); // Remove image from oldImages array
                                renderPreviewEdit(); // Re-render preview
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
                            const imageContainer = document.createElement('div');
                            imageContainer.classList.add('relative');

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm',
                                'border', 'border-gray-300');

                            const removeButtonNew = document.createElement('button');
                            removeButtonNew.type = 'button';
                            removeButtonNew.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500',
                                'text-white', 'rounded-full', 'p-1');
                            removeButtonNew.textContent = '✕';

                            // Remove new image on click
                            removeButtonNew.addEventListener('click', function() {
                                selectedNewFiles.splice(index, 1); // Remove file from array
                                renderPreviewEdit(); // Re-render preview
                            });

                            imageContainer.appendChild(img);
                            imageContainer.appendChild(removeButtonNew);
                            previewEdit.appendChild(imageContainer);
                        };
                        reader.readAsDataURL(file);
                    });
                }

                // Preview new images function
                function previewImagesEdit(event) {
                    const files = Array.from(event.target.files); // Get files from input

                    files.forEach(file => {
                        if (!selectedNewFiles.some(f => f.name === file.name && f.size === file.size)) {
                            selectedNewFiles.push(file); // Add file if not already present
                        }
                    });

                    renderPreviewEdit(); // Update preview
                }
            }

            // Ajax tìm kiếm
            $("#search").on('keyup', debounce(function() {
                let keyword = $(this).val();
                $.ajax({
                    url: $('#searchForm').attr('action'),
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function(response) {
                        console.log(response);
                        $('#variant-list').html(response
                            .html); // Cập nhật lại danh sách variants

                        // Gắn lại các sự kiện cho các nút modal sau khi kết quả được tải về
                        attachModalEvents();
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi tìm kiếm. Vui lòng thử lại!');
                    }
                });
            }, 500));

            attachModalEvents();
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
        #modal_create_variant {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_create_variant::-webkit-scrollbar {
            width: 8px;
        }

        #modal_create_variant::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_create_variant {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }

        #modal_edit_variant {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_edit_variant::-webkit-scrollbar {
            width: 8px;
        }

        #modal_edit_variant::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_edit_variant {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }

       
    </style>
@endpush
