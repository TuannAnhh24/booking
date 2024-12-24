@extends('admin.layouts.master-layout')
@section('content')
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
            <div
                class="p-6 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 w-full shadow-lg rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class='flex items-center justify-between gap-8 mb-8'>
                        <div>
                            <h5
                                class='block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900'>
                                {{ __('content.characteristic.characteristic_list') }}
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
                                        {{ __('content.destination.search') }}
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
                                        <a href="{{ route('admin.characteristics.trash') }}"
                                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">{{__('content.location.trash')}}</a>
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
                                {{ __('content.characteristic.add') }}
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
                                    ID</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.characteristic.name') }}</th>
                                <th
                                    class="px-4 bg-gray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.characteristic.action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($characteristics as $characteristic)
                                <tr class="text-gray-700">
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $characteristic->id }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $characteristic->name }}</td>

                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">

                                        <button
                                            class='edit-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            title='Edit' type='button' data-id="{{ $characteristic->id }}">
                                            <i class="ri-pencil-line text-xl"></i>
                                        </button>

                                        <button
                                            class='delete-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-red-400 transition-all hover:bg-red-500/10 active:bg-red-500/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type="button" title='Delete' data-id="{{ $characteristic->id }}">
                                            <i class="ri-delete-bin-line text-xl"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <!-- Hiển thị phân trang -->
                     <div class="w-full flex justify-between items-center p-0">
                        {{ $characteristics->links('admin.layouts.pagination') }}
                    </div>
                </div>
                 
                @include('admin.characteristics.add')
                @isset($characteristic)
                    @include('admin.characteristics.edit')
                    @include('admin.characteristics.delete')
                @endisset




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
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('modal_add_product');
            const openModalButton = document.getElementById('open_modal_button');
    
            // Mở modal khi bấm nút
            openModalButton.addEventListener('click', function () {
                modal.showModal();
            });
    
            // Đóng modal khi bấm nút close
            document.querySelector('.btn-ghost').addEventListener('click', function () {
                modal.close();
            });
    
            // Gửi form với Ajax khi nhấn nút submit
            $(document).ready(function () {
                let isSubmitting = false; // Cờ kiểm tra trạng thái gửi
    
                let errorElement = document.querySelector('.update-error');
                // Gỡ sự kiện cũ nếu có
                $('#submit-all-characteristics').off('click');
    
                // Đăng ký sự kiện mới
                $('#submit-all-characteristics').on('click', function (event) {
                    event.preventDefault(); // Ngăn không cho gửi form theo cách mặc định
                    $('.message').remove()
                    if (errorElement) {
                        errorElement.remove();
                    }
                    if (isSubmitting) {
                        // Nếu đang gửi thì không làm gì cả
                        return;
                    }
    
                    // Đặt trạng thái đang gửi
                    isSubmitting = true;
    
                    var form = $('#form-add-characteristic'); // Lấy đối tượng form
                    var formData = new FormData(form[0]); // Lấy dữ liệu từ form
    
                    $.ajax({
                        url: form.attr('action'), // Lấy URL action đã được thiết lập động
                        type: 'POST', // Phương thức gửi (POST)
                        data: formData, // Dữ liệu gửi đi
                        processData: false, // Ngăn jQuery xử lý dữ liệu vì chúng ta dùng FormData
                        contentType: false, // Ngăn jQuery đặt tiêu đề content-type
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Đảm bảo CSRF token
                        },
                        success: function (response, textStatus, xhr) {
                            if (xhr.status === 200 || xhr.status === 302) {
                                form[0].reset();
                                location.reload();
                            }
                        },
                        error: function (xhr) {
                            var errors = xhr.responseJSON.errors;
    
                            $.each(errors, function (key, value) {
                                var inputElement = $('[name="' + key + '"]');
                                
                                // Xóa thông báo lỗi cũ trước khi chèn thông báo mới
                                inputElement.find('.message').remove();
    
                                // Chèn thông báo lỗi sau toàn bộ phần tử chứa Select2
                                inputElement.after('<div class="message text-red-700">' + value[0] + '</div>');
                            });
                        },
                        complete: function () {
                            // Đặt lại trạng thái gửi sau khi hoàn thành
                            isSubmitting = false;
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('modal_delete_characteristic');
            const formDeleteCharacteristic = document.getElementById('form-delete-characteristic');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const characteristicId = this.getAttribute('data-id');
                    formDeleteCharacteristic.action = `/admin/characteristics/delete/${characteristicId}`;
                    deleteModal.showModal();
                });
            });

            // // Gửi form với Ajax khi nhấn nút xóa
            $(document).ready(function() {
                $('#submit_delete_characteristic').on('click', function(event) {
                    event.preventDefault(); // Ngăn không cho gửi form theo cách mặc định

                    var form = $('#form-delete-characteristic'); // Lấy đối tượng form
                    var formData = new FormData(form[0]); // Lấy dữ liệu từ form


                    $.ajax({
                        url: form.attr('action'), // Lấy URL action đã được thiết lập động
                        type: 'POST', // Phương thức gửi (POST)
                        data: formData, // Dữ liệu gửi đi
                        processData: false, // Ngăn jQuery xử lý dữ liệu vì chúng ta dùng FormData
                        contentType: false, // Ngăn jQuery đặt tiêu đề content-type
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // Đảm bảo CSRF token
                        },
                        success: function(response, textStatus, xhr) {
                            if (xhr.status === 200 || xhr.status === 302) {
                                // Reset form sau khi thành công
                                form[0].reset();
                                // Reload lại trang sau vài giây (nếu cần)
                                setTimeout(function() {
                                    location.reload();
                                }, 2000); // Reload trang sau 2 giây
                            }
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {
                                var inputElement = $('[name="' + key + '"]');

                                // Xóa thông báo lỗi cũ trước khi chèn thông báo mới
                                inputElement.find(
                                    '.message');

                                // Chèn thông báo lỗi sau toàn bộ phần tử chứa Select2
                                inputElement.after(
                                    '<div class="message text-red-700">' +
                                    value[0] + '</div>');
                            });
                        }
                    });
                });
            });

            document.querySelector('#modal_delete_characteristic .btn-ghost').addEventListener('click', function() {
                deleteModal.close();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const openModalButtons = document.querySelectorAll('button[title="Edit"]');
            let isFetching = false; // Cờ kiểm tra trạng thái để ngăn gửi nhiều yêu cầu cùng lúc
            
            // Mở modal khi nhấn vào nút "Edit"
            openModalButtons.forEach(button => {
                button.addEventListener('click', function () {
                    if (isFetching) {
                        // Nếu đang fetch, bỏ qua click mới
                        return;
                    }
    
                    const characteristicId = this.getAttribute('data-id');
                    console.log(characteristicId);
                    isFetching = true; // Đặt trạng thái đang fetch
    
                    // Gửi yêu cầu lấy nội dung để cập nhật
                    fetch(`/admin/characteristics/edit/${characteristicId}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            isFetching = false; // Đặt lại cờ khi hoàn thành yêu cầu
                            let existingModal = document.getElementById('modal_update_product');
                            if (existingModal) {
                                existingModal.remove(); // Xóa modal cũ nếu tồn tại
                            }
                            document.body.insertAdjacentHTML('beforeend', html);
                            const modal = document.getElementById('modal_update_product');
                            if (modal) {
                                modal.showModal(); // Hiển thị modal
    
                                function validateRequiredUpdateChara(value) {
                                    return value.trim() !== '';
                                }
                                const nameInput = modal.querySelector('[name="name"]');
                                addValidation(nameInput, 'Tên đặc điểm không được để trống', validateRequiredUpdateChara);

                                let isSubmitting = false; // Cờ kiểm tra trạng thái gửi form
                                
                                // Gửi form với Ajax khi nhấn nút submit
                                $('#submit-edit-characteristic').off('click').on('click', function (event) {
                                    event.preventDefault(); // Ngăn gửi form mặc định
                                    $('.message').remove()
                                    $('.update-error').remove();

                                    if (isSubmitting) {
                                        // Nếu đang gửi, bỏ qua click mới
                                        return;
                                    }
    
                                    isSubmitting = true; // Đặt trạng thái đang gửi
                                    var form = $('#form-edit-characteristic'); // Lấy đối tượng form
                                    var formData = new FormData(form[0]); // Lấy dữ liệu từ form

                                    $.ajax({
                                        url: form.attr('action'), // URL action đã được thiết lập
                                        type: 'POST', // Phương thức gửi (POST)
                                        data: formData, // Dữ liệu gửi đi
                                        processData: false, // Ngăn jQuery xử lý dữ liệu
                                        contentType: false, // Ngăn jQuery đặt tiêu đề content-type
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                                        },
                                        success: function (response, textStatus, xhr) {
                                            if (xhr.status === 200 || xhr.status === 302) {
                                                form[0].reset(); // Reset form
                                                location.reload(); // Reload lại trang
                                            }
                                        },
                                        error: function (xhr) {
                                            var errors = xhr.responseJSON.errors;
                                            $.each(errors, function (key, value) {
                                                var inputElement = $('[name="' + key + '"]');
                                                inputElement.find('.message').remove();
                                                inputElement.after('<div class="message text-red-700">' + value[0] + '</div>');
                                            });
                                        },
                                        complete: function () {
                                            isSubmitting = false; // Đặt lại trạng thái gửi
                                        }
                                    });
                                });
    
                                // Đóng modal khi nhấn nút close
                                const closeModalButton = modal.querySelector('#btn-close-modal');
                                if (closeModalButton) {
                                    closeModalButton.addEventListener('click', function () {
                                        modal.close(); // Đóng modal
                                    });
                                }
                            }
                        })
                        .catch(error => {
                            isFetching = false; // Đặt lại cờ trong trường hợp lỗi
                            console.error('Lỗi:', error);
                        });
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