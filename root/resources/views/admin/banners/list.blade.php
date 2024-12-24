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
                                {{ __('content.banner.banner_list') }}
                            </h5>
                        </div>
                        @if (session('success'))
                            <div class="bg-green-500 text-white p-4 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="bg-red-500 text-white p-4 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
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
                                        {{ __('content.banner.search') }}
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
                                        <a href="{{ route('admin.banners.trash') }}"
                                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"><i
                                                class="ri-delete-bin-line text-xl"></i>
                                            {{ __('content.banner.trash') }}</a>
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
                                {{ __('content.banner.add_banner') }}
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
                                    {{ __('content.banner.id') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.banner.banner_image') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.banner.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr class="text-gray-700 ">
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        {{ $banner->id }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($banner->img_banner)
                                            <img src="{{ asset('storage/' . $banner->img_banner) }}" alt=""
                                                class="h-32 w-32 object-cover rounded-md shadow-sm border border-gray-300 banner-image">
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <button
                                            class='edit-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type='button' title='Edit' data-id='{{ $banner->id }}'>
                                            <i class="ri-pencil-line text-xl"></i>
                                        </button>
                                        <button
                                            class='delete-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-red-400 transition-all hover:bg-red-500/10 active:bg-red-500/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type='button' title='Delete' data-id='{{ $banner->id }}'>
                                            <i class="ri-delete-bin-line text-xl"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-full flex justify-between items-center p-0">
                        {{ $banners->links('admin.layouts.pagination') }}
                    </div>
                </div>
                @include('admin.banners.modal.add')
                @include('admin.banners.modal.delete')
                @include('admin.banners.modal.edit')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal_add_product');
            const openModalButton = document.getElementById('open_modal_button');

            // Mở modal khi nhấn nút
            openModalButton.addEventListener('click', function() {
                modal.showModal();
            });
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.close();
                }
            });
        });

        let fileList = []; // Mảng chứa các file đã chọn

        function previewAddImages(event) {
            const preview = document.getElementById('previewAdd');
            preview.innerHTML = '';

            // Lưu các file đã chọn vào mảng fileList
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

        document.getElementById('form-add-banner').addEventListener('submit', function(event) {
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
            $('#form-add-banner').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);
                $.ajax({
                    url: "{{ route('admin.banners.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modal_add_product')[0].close();
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $('.text-red-500').remove();

                            // Hiển thị lỗi cho trường images
                            if (errors.images) {
                                let errorElement = $(
                                        '<div class="text-red-500 text-sm mt-2"></div>')
                                    .text(errors.images[0]);
                                $('#imagesAdd').closest('.sm\\:col-span-2').append(
                                    errorElement);
                            }
                        }
                    },
                    complete: function() {
                        submitButton.prop('disabled', false);
                    }
                });
            });
        });




        $('#form-delete-banner').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true); // Vô hiệu hóa nút submit để ngăn gửi trùng

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#modal_delete_banner')[0].close();
                    location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-red-500').remove();

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let input = $(`[name="${key}"]`);
                                let errorElement = $('<div class="text-red-500 text-sm mt-2"></div>')
                                    .text(errors[key][0]);
                                input.after(errorElement);
                            }
                        }
                    } else {
                        alert("Đã xảy ra lỗi. Vui lòng thử lại sau.");
                    }
                },
                complete: function() {
                    submitButton.prop('disabled', false);
                }
            });
        });

        document.querySelector('#modal_add_product .btn-ghost').addEventListener('click', function() {
            document.getElementById('modal_add_product').close();

            $('.text-red-500').remove();

            $('#form-add-banner')[0].reset();
        });

        document.querySelector('#modal_delete_banner .btn-ghost').addEventListener('click', function() {
            document.getElementById('modal_delete_banner').close();

            $('.text-red-500').remove();

            $('#form-delete-banner')[0].reset();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('modal_delete_banner');
            const formDeleteBanner = document.getElementById('form-delete-banner');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bannerId = this.getAttribute('data-id');
                    formDeleteBanner.action = `/admin/banners/delete/${bannerId}`;
                    deleteModal.showModal();
                });
            });

            document.querySelector('#modal_delete_banner .btn-ghost').addEventListener('click', function() {
                deleteModal.close();
            });
        });
    </script>
    <script>
        function previewEditImages(event) {
            const previewEdit = document.getElementById('editpreview');
            previewEdit.innerHTML = '';

            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('h-32', 'w-32', 'object-cover', 'rounded-md', 'shadow-sm', 'border',
                        'border-gray-300');
                    previewEdit.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtons = document.querySelectorAll('button[title="Edit"]');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const bannerId = this.getAttribute('data-id');
                    fetch(`/admin/banners/edit/${bannerId}/`, {
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
        document.addEventListener('DOMContentLoaded', () => {
            const images = document.querySelectorAll('.banner-image');

            images.forEach(image => {
                image.addEventListener('click', () => {
                    // Tạo overlay
                    const overlay = document.createElement('div');
                    overlay.classList.add('overlay');

                    // Tạo ảnh lớn
                    const largeImage = document.createElement('img');
                    largeImage.src = image.src;
                    overlay.appendChild(largeImage);

                    // Thêm nút đóng
                    const closeButton = document.createElement('div');
                    closeButton.classList.add('overlay-close');
                    closeButton.innerHTML = '&times;';
                    overlay.appendChild(closeButton);

                    // Đóng overlay khi click vào nút đóng
                    closeButton.addEventListener('click', () => {
                        overlay.remove();
                    });

                    // Đóng overlay khi click vào bên ngoài ảnh
                    overlay.addEventListener('click', (e) => {
                        if (e.target === overlay) {
                            overlay.remove();
                        }
                    });

                    // Thêm overlay vào body
                    document.body.appendChild(overlay);
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

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .overlay img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 8px;
        }

        .overlay-close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }
    </style>
@endpush
