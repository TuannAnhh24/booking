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
                                {{ __('content.banner.trash_list') }}
                            </h5>
                        </div>
                        <div class='flex flex-col gap-2 shrink-0 sm:flex-row'>
                            <a href="{{ route('admin.banners.index') }}" 
                                class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>
                                {{ __('content.banner.back') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.banner.id') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.banner.banner_image') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.banner.description') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    {{ __('content.banner.deleted_at') }}</th>
                                <th
                                    class="px-4 bg-gray-100 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                    {{ __('content.banner.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="banner-list">
                            @foreach ($banners as $banner)
                                <tr class="text-gray-700">
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                        {{ $banner->id }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        @if ($banner->img_banner)
                                            <button class="open-modal-btn" data-id="{{ $banner->id }}">
                                                <img src="{{ asset('storage/' . $banner->img_banner) }}" alt=""
                                                    class="h-24 w-24 object-cover rounded-md shadow-sm border border-gray-300">
                                            </button>
                                        @else
                                            <p>{{ __('content.banner.no_image') }}</p>
                                        @endif
                                    </td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $banner->description ? $banner->description : __('content.banner.no_description') }}
                                    </td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        {{ $banner->deleted_at->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <button
                                            class='restore-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-green-600 transition-all hover:bg-green-600/10 active:bg-green-600/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type='button' title='{{ __('content.banner.restore') }}'
                                            data-id='{{ $banner->id }}'>
                                            <i class="ri-refresh-line text-xl"></i>
                                        </button>
                                        <button
                                            class='delete-permanent-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-red-600 transition-all hover:bg-red-600/10 active:bg-red-600/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                                            type='button' title='{{ __('content.banner.delete_permanent') }}'
                                            data-id='{{ $banner->id }}'>
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
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.restore-button', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Xác nhận khôi phục?',
                    text: "Danh mục này sẽ được khôi phục!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu AJAX
                        $.ajax({
                            url: `/admin/banners/restore/${id}`,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Đang xử lý...',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function() {
                                // Reload lại trang
                                window.location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Không thể khôi phục danh mục này'
                                });
                            }
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $(document).on('click', '.delete-permanent-button', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Danh mục này sẽ bị xóa vĩnh viễn và không thể khôi phục!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi yêu cầu DELETE mà không cần xử lý JSON
                        $.ajax({
                            url: `/admin/banners/forceDelete/${id}`,
                            type: 'GET',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Đang xử lý...',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function() {
                                // Reload lại trang sau khi server xử lý
                                window.location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Không thể xóa danh mục này.'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
