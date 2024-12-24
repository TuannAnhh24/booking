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
                                {{ __('content.promotion.promotion_list') }}
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
                                    <form id="searchForm" method="GET" action="{{ route('admin.promotion.index') }}">
                                        <input id="search" name="keyword"
                                            class='peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50'
                                            placeholder='' />
                                        <label
                                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all">
                                            {{ __('content.user.search') }}
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
                                        <a href="{{ route('admin.promotion.trash') }}"
                                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50"><i
                                                class="ri-delete-bin-line text-xl"></i>
                                            {{ __('content.category.trash') }}</a>
                                    </li>
                                </ul>
                                </button>
                            </div>

                            <button
                                class='flex select-none items-center gap-3 rounded-lg bg-blue-600 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-600/10 transition-all hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                type='button' id='open_modal_add_button'>
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'
                                    aria-hidden='true' strokeWidth='2' class='w-4 h-4'>
                                    <path
                                        d='M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z'>
                                    </path>
                                </svg>
                                {{ __('content.promotion.add_promotion') }}
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
                                    {{ __('content.promotion.code') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.promotion.start_date') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.promotion.end_date') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.promotion.short_description') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.promotion.quantity') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.promotion.action') }}</th>
                            </tr>
                        </thead>

                        <tbody id="promotion-list">
                            @include('admin.promotion.partials.table')
                        </tbody>

                    </table>
                    <!-- Phân trang -->
                    <div class="w-full flex justify-between items-center p-0">
                        {{ $listPromotion->links('admin.layouts.pagination') }}</div>
                    </div>

            </div>
            @include('admin.promotion.modal.create_promotion')
            @include('admin.promotion.modal.delete_promotion')
            @isset($promotion)
                @include('admin.promotion.modal.detail_promotion')
                @include('admin.promotion.modal.edit_promotion')
            @endisset

        </div>
    </div>
    </div>
@endsection

@push('scripts')
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

        // add
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Add Promotion
            const modalAdd = document.getElementById('modal_add_promotion');
            const openModalAddButton = document.getElementById('open_modal_add_button');

            function generateRandomCode() {
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let result = '';
                for (let i = 0; i < 8; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    result += characters[randomIndex];
                }
                document.getElementById('code').value = result; // Gán mã code vào input
            }

            if (openModalAddButton) {
                openModalAddButton.addEventListener('click', function() {
                    generateRandomCode(); // Gọi hàm tạo mã ngẫu nhiên ngay khi mở modal
                    modalAdd.showModal();
                });
            }

            if (modalAdd) {
                modalAdd.addEventListener('click', function(event) {
                    if (event.target === modalAdd) {
                        modalAdd.close();
                    }
                });
            }

        });

        // delete 
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('[data-action="delete"]');
            const deleteModal = document.getElementById('modal_delete_promotion');
            const formDeletePromotions = document.getElementById('form-delete-promotion');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const promotionId = this.getAttribute('data-id');
                    // Cập nhật URL action của form
                    formDeletePromotions.action = `/admin/promotion/${promotionId}/destroy`;
                    // Hiển thị modal
                    deleteModal.showModal();
                });
            });

            // Thêm sự kiện cho nút đóng modal
            document.querySelector('#modal_delete_promotion .btn-ghost').addEventListener('click', function() {
                deleteModal.close();
            });
        });

        // detail
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButtonsEdit = document.querySelectorAll('.detail-button');

            openModalButtonsEdit.forEach(button => {
                button.addEventListener('click', function() {
                    const promotionId = this.getAttribute('data-id');

                    // Fetch dữ liệu modal từ server
                    fetch(`/admin/promotion/${promotionId}/show`)
                        .then(response => response.text())
                        .then(html => {
                            // Xóa modal hiện có (nếu có)
                            const existingModal = document.getElementById(
                                'modal_detail_promotion');
                            if (existingModal) {
                                existingModal.remove();
                            }

                            // Thêm modal mới vào body
                            document.body.insertAdjacentHTML('beforeend', html);

                            // Lấy phần tử modal mới
                            const modalEdit = document.getElementById('modal_detail_promotion');
                            if (!modalEdit) {
                                console.error(
                                    "Không tìm thấy modal với ID 'modal_detail_promotion'");
                                return;
                            }

                            // Hiển thị modal
                            modalEdit.showModal();

                            // Đóng modal khi nhấn nút đóng
                            closeModalButtonEdit.addEventListener('click', function() {
                                modalEdit.close();
                            });

                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        });

        // Khi người dùng nhấn nút để mở modal
        $('#openCreatePromotionModal').on('click', function() {
            $.ajax({
                url: "{{ route('admin.promotion.create') }}", // Gọi route để lấy mã random
                method: 'GET',
                success: function(response) {
                    if (response.randomCode) {
                        // Chèn mã random vào input của modal
                        $('#promotionModal #code').val(response.randomCode);
                        // Mở modal
                        $('#promotionModal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    alert("Đã xảy ra lỗi khi tạo mã khuyến mãi. Vui lòng thử lại.");
                }
            });
        });
        // Validate Xóa
        $('#form-delete-promotion').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    const modal = document.getElementById('modal_delete_promotion');
                    if (modal) {
                        modal.close(); // Sử dụng DOM API thay vì jQuery
                    }
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
                    }
                }
            });
        });
        // Validate thêm mới
        $(document).ready(function() {
            $('#form-add-promotion').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.promotion.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modal_add_promotion')[0].close();
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
                                    $(`#${key}`).after(
                                        errorElement
                                    );
                                }
                            }
                        } else {
                            console.error('Có lỗi xảy ra, vui lòng thử lại!');
                        }
                    }
                });
            });
        });
        // Validate Sửa
        $(document).ready(function() {
            const openModalButtons = document.querySelectorAll('button[title="Edit"]');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    console.log("vào đây rồi thì phải >???")
                    event.stopPropagation();
                    const promotionId = this.getAttribute('data-id');

                    // Gửi yêu cầu lấy nội dung modal
                    fetch(`/admin/promotion/${promotionId}/edit`, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Mã lỗi: ' + response.status);
                            }
                            return response.text();
                        })
                        .then(html => {
                            // Xóa modal cũ nếu tồn tại
                            const existingModal = document.getElementById(
                                'modal_edit_promotion');
                            if (existingModal) {
                                existingModal.remove();
                            }

                            // Chèn HTML mới vào body
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modal = document.getElementById('modal_edit_promotion');

                            // Kiểm tra modal có tồn tại hay không
                            if (modal) {
                                modal.showModal(); // Hiện modal
                                const discountTypeSelect = document.getElementById(
                                'discount_type-edit');
                            if (discountTypeSelect) {
                                discountTypeSelect.addEventListener('change', function() {
                                    const discountTypeValue = this.value;
                                    const percentDiscountEdit = document.getElementById(
                                        'percent_discount-edit');
                                    const amountDiscountEdit = document.getElementById(
                                        'amount_discount-edit');
                                    if (discountTypeValue === 'percentage') {
                                        percentDiscountEdit.classList.remove("hidden")
                                        amountDiscountEdit.classList.add("hidden")
                                    } else if (discountTypeValue === 'amount') {
                                        percentDiscountEdit.classList.add("hidden")
                                        amountDiscountEdit.classList.remove("hidden")
                                    } else {
                                        percentDiscountEdit.style.display = 'none';
                                        amountDiscountEdit.style.display = 'none';
                                    }
                                });
                            } else {
                                console.error(
                                    "Không tìm thấy phần tử với ID 'discount_type-edit'");
                            }
                                // Đặt ID vào hidden field
                                $('#promotion_id').val(promotionId);
                                const url =
                                    "{{ route('admin.promotion.update', ['id' => ':id']) }}"
                                    .replace(':id', promotionId);

                                // Bắt sự kiện submit cho form bên trong modal
                                $('#form-update-promotion').on('submit', function(e) {
                                    e.preventDefault(); // Ngăn chặn hành động mặc định

                                    let formData = new FormData(
                                        this); // Định nghĩa formData

                                    // Gửi yêu cầu cập nhật
                                    $.ajax({
                                        url: url,
                                        type: "POST",
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            modal.close(); // Đóng modal
                                            location
                                                .reload(); // Tải lại trang
                                        },
                                        error: function(xhr) {
                                            if (xhr.status === 422) {
                                                let errors = xhr
                                                    .responseJSON.errors;

                                                // Xóa thông báo lỗi cũ chỉ trong modal sửa
                                                $('#form-update-promotion .text-red-500')
                                                    .remove();

                                                // Hiển thị thông báo lỗi cho từng trường
                                                for (let key in errors) {
                                                    if (errors
                                                        .hasOwnProperty(key)
                                                    ) {
                                                        let errorElement =
                                                            $(
                                                                '<div class="text-red-500 text-sm mt-2"></div>'
                                                            )
                                                            .text(errors[
                                                                key][0]);
                                                        $(`#${key}-edit`)
                                                            .after(
                                                                errorElement
                                                            ); // Sử dụng ID cho modal sửa
                                                    }
                                                }
                                            } else {
                                                console.error(
                                                    'Có lỗi xảy ra, vui lòng thử lại!'
                                                ); // Thông báo lỗi chung
                                            }
                                        }
                                    });
                                });
                            } else {
                                console.error("Modal không tồn tại!");
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        });
        // Ajax tìm kiếm
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
                        $('#promotion-list').html(response.html);
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
            // Gắn sự kiện cho nút xóa
            const deleteButtons = document.querySelectorAll('[data-action="delete"]');
            const deleteModal = document.getElementById('modal_delete_promotion');
            const formDeletePromotions = document.getElementById('form-delete-promotion');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const promotionId = this.getAttribute('data-id');
                    formDeletePromotions.action = `/admin/promotion/${promotionId}/destroy`;
                    deleteModal.showModal();
                });
            });

            // Gắn sự kiện cho nút chi tiết
            const openModalButtonsDetail = document.querySelectorAll('.detail-button');
            openModalButtonsDetail.forEach(button => {
                button.addEventListener('click', function() {
                    const promotionId = this.getAttribute('data-id');
                    fetch(`/admin/promotion/${promotionId}/show`)
                        .then(response => response.text())
                        .then(html => {
                            const existingModal = document.getElementById('modal_detail_promotion');
                            if (existingModal) {
                                existingModal.remove();
                            }
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modalDetail = document.getElementById('modal_detail_promotion');
                            modalDetail.showModal();

                            // Đóng modal
                            const closeModalButtonDetail = modalDetail.querySelector('.btn-ghost');
                            closeModalButtonDetail.addEventListener('click', function() {
                                modalDetail.close();
                            });
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        }
    </script>
@endpush

@push('style')
    <style>
        #modal_add_promotion {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_add_promotion::-webkit-scrollbar {
            width: 8px;
        }

        #modal_add_promotion::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_add_promotion {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
        }

        #modal_edit_promotion {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_edit_promotion::-webkit-scrollbar {
            width: 8px;
        }

        #modal_edit_promotion::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_edit_promotion {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;

        }


        #modal_detail_promotion {
            overflow-y: auto;
            border-radius: 24px;
            position: relative;
        }

        #modal_detail_promotion::-webkit-scrollbar {
            width: 8px;
        }

        #modal_detail_promotion::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        #modal_detail_promotion {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;

        }
    </style>
@endpush
