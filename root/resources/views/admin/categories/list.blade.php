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
                                {{ __('content.category.category_list') }}
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
                                    <form id="searchForm" method="GET" action="{{ route('admin.categories.index') }}">
                                        <input id="search" name="keyword"
                                            class='peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50'
                                            placeholder='' />
                                        <label
                                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all">
                                            {{ __('content.category.search') }}
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
                                        <a href="{{ route('admin.categories.trash') }}"
                                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"><i
                                                class="ri-delete-bin-line text-xl"></i>
                                            {{ __('content.category.trash') }}</a>
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
                                {{ __('content.category.add_category') }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.category.id') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.category.name') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.category.category_image') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.category.description') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.category.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="category-list">
                            @include('admin.categories.partials.table')
                        </tbody>
                    </table>
                    <div class="w-full flex justify-between items-center p-0">
                        {{ $categories->links('admin.layouts.pagination') }}</div>
                </div>
                @include('admin.categories.modal.add')
                @include('admin.categories.modal.delete')
                @include('admin.categories.modal.edit')
                @include('admin.categories.modal.image')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function addValidation(inputElement, errorMessage, validateFn) {
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
            const modal = document.getElementById('modal_add_product');
            const openModalButton = document.getElementById('open_modal_button');

            openModalButton.addEventListener('click', function() {
                modal.showModal();
            });
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.close();
                }
            });
        });

        let fileList = [];

        function previewAddImages(event) {
            const preview = document.getElementById('previewAdd');
            preview.innerHTML = '';

            fileList = Array.from(event.target.files);

            fileList.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('relative', 'inline-block', 'mr-2');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm', 'border',
                        'border-gray-300');

                    const removeButton = document.createElement('button');
                    removeButton.innerHTML = 'X';
                    removeButton.type = 'button';
                    removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500', 'text-white',
                        'rounded-full', 'p-1', 'text-xs', 'hover:bg-red-700');
                    removeButton.onclick = function() {
                        fileList.splice(index, 1);
                        updatePreview();
                    };

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(removeButton);
                    preview.appendChild(imgWrapper);
                };

                reader.readAsDataURL(file);
            });

            document.getElementById('imagesAdd').value = '';
        }

        function updatePreview() {
            const preview = document.getElementById('previewAdd');
            preview.innerHTML = '';

            fileList.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('relative', 'inline-block', 'mr-2');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm', 'border',
                        'border-gray-300');

                    const removeButton = document.createElement('button');
                    removeButton.innerHTML = 'X';
                    removeButton.type = 'button';
                    removeButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500', 'text-white',
                        'rounded-full', 'p-1', 'text-xs', 'hover:bg-red-700');
                    removeButton.onclick = function() {
                        fileList.splice(index, 1);
                        updatePreview();
                    };

                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(removeButton);
                    preview.appendChild(imgWrapper);
                };

                reader.readAsDataURL(file);
            });
        }

        document.getElementById('form-add-category').addEventListener('submit', function(event) {
            const form = event.target;
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'images[]';
            input.multiple = true;
            input.hidden = true;
            const dataTransfer = new DataTransfer();
            fileList.forEach(file => {
                dataTransfer.items.add(file);
            });
            input.files = dataTransfer.files;
            form.appendChild(input);
        });


        $(document).ready(function() {

            $('#form-add-category').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                // Vô hiệu hóa nút submit
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                $.ajax({
                    url: "{{ route('admin.categories.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modal_add_product')[0].close();
                        location.reload();
                        submitButton.prop('disabled', false);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $('.text-red-500').remove();
                            for (let key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    let errorElement = $(
                                            '<div class="text-red-500 text-sm mt-2"></div>')
                                        .text(errors[key][0]);
                                    $(`#${key}`).after(errorElement);
                                }
                            }

                            submitButton.prop('disabled', false);
                        } else {
                            console.error('Có lỗi xảy ra, vui lòng thử lại!');
                            submitButton.prop('disabled', false);
                        }
                    }
                });
            });

            $('#form-delete-category').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modal_delete_category')[0].close();
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            $('.text-red-500').remove();

                            for (let key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    let errorElement = $(
                                            '<div class="text-red-500 text-sm mt-2"></div>')
                                        .text(errors[key][0]);
                                    $(`#${key}`).after(errorElement);
                                }
                            }
                            submitButton.prop('disabled', false);
                        } else {
                            alert('Có lỗi xảy ra, vui lòng thử lại!');
                            submitButton.prop('disabled', false);
                        }
                    }
                });
            });

            document.querySelector('#modal_add_product .btn-ghost').addEventListener('click', function() {
                document.getElementById('modal_add_product').close();

                $('.text-red-500').remove();

                $('#form-add-category')[0].reset();
            });

            document.querySelector('#modal_delete_category .btn-ghost').addEventListener('click', function() {
                document.getElementById('modal_delete_category').close();

                $('.text-red-500').remove();

                $('#form-delete-category')[0].reset();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('modal_delete_category');
            const formDeleteCategory = document.getElementById('form-delete-category');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    formDeleteCategory.action = `/admin/categories/delete/${categoryId}`;
                    deleteModal.showModal();
                });
            });

            document.querySelector('#modal_delete_category .btn-ghost').addEventListener('click', function() {
                deleteModal.close();
            });
        });
    </script>
    <script>
        function previewEditImages(event) {
            const previewEdit = document.getElementById('editpreview');
            const inputFile = event.target;
            previewEdit.innerHTML = '';

            const files = inputFile.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.classList.add('relative', 'inline-block', 'mr-2');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm', 'border',
                        'border-gray-300');
                    imgContainer.appendChild(img);
                    const deleteButton = document.createElement('button');
                    deleteButton.innerText = 'Xóa';
                    deleteButton.classList.add('absolute', 'top-0', 'right-0', 'bg-red-500', 'text-white',
                        'rounded-full', 'p-1', 'text-xs', 'hover:bg-red-600');
                    deleteButton.onclick = function() {
                        imgContainer.remove();
                        const newFiles = Array.from(inputFile.files).filter((_, index) => index !== i);
                        const dataTransfer = new DataTransfer();
                        newFiles.forEach(file => dataTransfer.items.add(file));
                        inputFile.files = dataTransfer.files;
                    };

                    imgContainer.appendChild(deleteButton);
                    previewEdit.appendChild(imgContainer);
                };

                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('button[title="Edit"]');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    fetch(`/admin/categories/edit/${categoryId}/`, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            const existingModal = document.getElementById(
                                'modal_update_product');
                            if (existingModal) {
                                existingModal.remove();
                            }
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modal = document.getElementById('modal_update_product');
                            if (!modal) {
                                console.error(
                                    "Không tìm thấy modal với ID 'modal_update_product'");
                                return;
                            }
                            modal.showModal();

                            const formUpdateCategory = document.querySelector(
                                '#form-update-category');
                            if (formUpdateCategory) {
                                const updateUrl = `/admin/categories/update/${categoryId}`;
                               
                                formUpdateCategory.querySelectorAll('input, select, textarea').forEach(input => {
                                    input.addEventListener('change', function() { 
                                        function validateRequiredNameUpdate(value) {
                                            return value.trim() !== ''; 
                                        }

                                        const inputNameUpdate = document.getElementById('update_name');
                                        
                                        addValidation(inputNameUpdate, 'Tên danh mục không được để trống', validateRequiredNameUpdate);
                                    });
                                });
                                
                                formUpdateCategory.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    console.log('Submitting update form');

                                    let formData = new FormData(this);
                                    const submitButton = this.querySelector(
                                        'button[type="submit"]');
                                    $(submitButton).prop('disabled',
                                        true); // Disable button while submitting

                                    $.ajax({
                                        url: updateUrl,
                                        type: "POST",
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            $('#modal_update_product')[0]
                                                .close(); // Close the modal
                                            location
                                                .reload(); // Reload the page to reflect changes
                                        },
                                        error: function(xhr) {
                                            if (xhr.status === 422) {
                                                let errors = xhr
                                                    .responseJSON.errors;

                                                // Clear previous errors
                                                $('.update-error').remove();

                                                // Pass errors to the Blade template
                                                for (let key in errors) {
                                                    if (errors
                                                        .hasOwnProperty(key)
                                                    ) {
                                                        let errorElement =
                                                            $(
                                                                '<div class="update-error text-red-500 text-sm mt-2"></div>'
                                                            )
                                                            .text(errors[
                                                                key][0]);
                                                        $(`#update_${key}`)
                                                            .after(
                                                                errorElement
                                                            );
                                                    }
                                                }
                                            } else {
                                                console.error(
                                                    'Có lỗi xảy ra, vui lòng thử lại!'
                                                );
                                            }
                                        },
                                        complete: function() {
                                            $(submitButton).prop('disabled',
                                                false);
                                        }
                                    });
                                });
                            }

                            // Clear errors when modal is closed
                            $('#modal_update_product').on('close', function() {
                                $('.update-error').remove();
                            });

                            const closeModalButton = modal.querySelector('.btn-close-modal');
                            if (!closeModalButton) {
                                console.error("Không tìm thấy nút đóng trong modal");
                                return;
                            }
                            closeModalButton.addEventListener('click', function() {
                                modal.close();
                            });
                            modal.addEventListener('click', function(event) {
                                if (event.target === modal) {
                                    modal.close();
                                }
                            });
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        });


        function removeImage(imageId) {
            const imagesToDeleteInput = document.getElementById('images_to_delete');
            let imagesToDelete = imagesToDeleteInput.value ? imagesToDeleteInput.value.split(',') : [];

            if (!imagesToDelete.includes(imageId.toString())) {
                imagesToDelete.push(imageId);
            }
            imagesToDeleteInput.value = imagesToDelete.join(',');

            document.querySelector(`button[onclick="removeImage(${imageId})"]`).parentElement.remove();
        }

        //Ajax tìm kiếm
        $(document).ready(function() {
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
                        $('#category-list').html(response.html);
                        attachModalEvents();
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi tìm kiếm. Vui lòng thử lại!');
                    }
                });
            }, 500));
        });

        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this,
                    args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        function attachModalEvents() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('modal_delete_category');
            const formDeleteCategory = document.getElementById('form-delete-category');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    formDeleteCategory.action = `/admin/categories/delete/${categoryId}`;
                    deleteModal.showModal();
                });
            });

            document.querySelector('#modal_delete_category .btn-ghost').addEventListener('click', function() {
                deleteModal.close();
            });

            const openModalButtons = document.querySelectorAll('button[title="Edit"]');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    fetch(`/admin/categories/edit/${categoryId}/`, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            const existingModal = document.getElementById('modal_update_product');
                            if (existingModal) {
                                existingModal.remove();
                            }
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modal = document.getElementById('modal_update_product');
                            if (!modal) {
                                console.error("Không tìm thấy modal với ID 'modal_update_product'");
                                return;
                            }
                            modal.showModal();

                            const formUpdateCategory = document.querySelector('#form-update-category');
                            if (formUpdateCategory) {
                                const updateUrl = `/admin/categories/update/${categoryId}`;
                                formUpdateCategory.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    console.log('Submitting update form');

                                    let formData = new FormData(this);
                                    const submitButton = this.querySelector(
                                        'button[type="submit"]');
                                    $(submitButton).prop('disabled',
                                        true);

                                    $.ajax({
                                        url: updateUrl,
                                        type: "POST",
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            $('#modal_update_product')[0]
                                                .close();
                                            location
                                                .reload();
                                        },
                                        error: function(xhr) {
                                            if (xhr.status === 422) {
                                                let errors = xhr.responseJSON
                                                    .errors;

                                                // Clear previous errors
                                                $('.update-error').remove();

                                                // Pass errors to the Blade template
                                                for (let key in errors) {
                                                    if (errors.hasOwnProperty(
                                                            key)) {
                                                        let errorElement = $(
                                                            '<div class="update-error text-red-500 text-sm mt-2"></div>'
                                                        ).text(errors[key][
                                                            0
                                                        ]);
                                                        $(`#update_${key}`).after(
                                                            errorElement);
                                                    }
                                                }
                                            } else {
                                                console.error(
                                                    'Có lỗi xảy ra, vui lòng thử lại!'
                                                );
                                            }
                                        },
                                        complete: function() {
                                            $(submitButton).prop('disabled', false);
                                        }
                                    });
                                });
                            }

                            $('#modal_update_product').on('close', function() {
                                $('.update-error').remove();
                            });

                            const closeModalButton = modal.querySelector('.btn-close-modal');
                            if (!closeModalButton) {
                                console.error("Không tìm thấy nút đóng trong modal");
                                return;
                            }
                            closeModalButton.addEventListener('click', function() {
                                modal.close();
                            });
                            modal.addEventListener('click', function(event) {
                                if (event.target === modal) {
                                    modal.close();
                                }
                            });
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        }

        const openModalBtns = document.querySelectorAll('.open-modal-btn');
        openModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const categoryId = btn.dataset.id;
                const modal = document.getElementById(`modal-${categoryId}`);
                modal.classList.remove('hidden');
            });
        });

        const closeModalBtns = document.querySelectorAll('.close-modal-btn');
        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.modal');
                modal.classList.add('hidden');
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            let activeOverlay = null;

            const showImageOverlay = (modalId, startIndex) => {
                const modalElement = document.getElementById(`modal-${modalId}`);
                const images = Array.from(modalElement.querySelectorAll('.modal-image'));
                let currentIndex = startIndex;

                // Create overlay with absolute positioning for navigation buttons
                const overlay = document.createElement('div');
                overlay.classList.add('fixed', 'inset-0', 'w-full', 'h-full', 'flex',
                    'items-center', 'justify-center', 'bg-black', 'bg-opacity-90', 'z-[9999]');

                // Image container without relative positioning to allow edge buttons
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('max-w-[80vw]', 'max-h-[90vh]', 'flex', 'items-center',
                    'justify-center');

                const largeImage = document.createElement('img');
                largeImage.classList.add('max-w-full', 'max-h-[90vh]', 'object-contain');

                const updateImage = () => {
                    const imgSrc = images[currentIndex].getAttribute('src');
                    largeImage.src = imgSrc;
                };

                updateImage();

                // Modified navigation button creation with edge positioning
                const createNavButton = (direction, symbol) => {
                    const button = document.createElement('button');
                    button.innerHTML = symbol;

                    // Common button styles
                    button.classList.add(
                        'fixed', 'top-0', 'h-full', // Full height button
                        'text-white', 'text-4xl', 'font-bold',
                        'px-6', // Wider clickable area
                        'hover:bg-black', 'hover:bg-opacity-30', // Subtle hover effect
                        'transition-all', 'focus:outline-none',
                        'flex', 'items-center', 'justify-center'
                    );

                    // Direction-specific styles
                    if (direction === 'prev') {
                        button.classList.add('left-0');
                    } else {
                        button.classList.add('right-0');
                    }

                    button.addEventListener('click', (e) => {
                        e.stopPropagation();
                        if (direction === 'prev') {
                            currentIndex = (currentIndex - 1 + images.length) % images.length;
                        } else {
                            currentIndex = (currentIndex + 1) % images.length;
                        }
                        updateImage();
                    });

                    // Add hover effect
                    button.addEventListener('mouseenter', () => {
                        button.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
                    });

                    button.addEventListener('mouseleave', () => {
                        button.style.backgroundColor = 'transparent';
                    });

                    return button;
                };

                const prevButton = createNavButton('prev', '❮');
                const nextButton = createNavButton('next', '❯');

                const handleKeyPress = (e) => {
                    if (e.key === 'ArrowLeft') {
                        currentIndex = (currentIndex - 1 + images.length) % images.length;
                        updateImage();
                    } else if (e.key === 'ArrowRight') {
                        currentIndex = (currentIndex + 1) % images.length;
                        updateImage();
                    } else if (e.key === 'Escape') {
                        closeOverlay();
                    }
                };

                const closeOverlay = () => {
                    document.removeEventListener('keydown', handleKeyPress);
                    overlay.remove();
                    activeOverlay = null;
                };

                // Add elements to DOM
                imageContainer.appendChild(largeImage);
                overlay.appendChild(imageContainer);
                overlay.appendChild(prevButton);
                overlay.appendChild(nextButton);

                overlay.addEventListener('click', (e) => {
                    if (e.target === overlay || e.target === imageContainer) {
                        closeOverlay();
                    }
                });

                document.addEventListener('keydown', handleKeyPress);
                document.body.appendChild(overlay);
                activeOverlay = overlay;
            };

            // Add click handlers to all modal images
            document.querySelectorAll('.modal-image').forEach((img) => {
                img.addEventListener('click', () => {
                    if (!activeOverlay) {
                        const modalId = img.getAttribute('data-modal-id');
                        const imageIndex = parseInt(img.getAttribute('data-image-index'), 10);
                        showImageOverlay(modalId, imageIndex);
                    }
                });
            });
        });
    </script>
@endpush

@push('style')
    <style>
        #modal_add_product {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_add_product::-webkit-scrollbar {
            width: 8px;
        }

        #modal_add_product::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_add_product {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }

        #modal_update_product {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_update_product::-webkit-scrollbar {
            width: 8px;
        }

        #modal_update_product::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_update_product {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }
    </style>
@endpush
