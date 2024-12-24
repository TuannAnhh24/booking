@extends('client.layouts.master-layout')

@section('content')
    @include('client.layouts.header')

    <div class="max-w-screen-lg container mx-auto mt-20 mb-40">

        @if ($bookings->isEmpty())
            <div class="flex flex-col items-center justify-center mt-20 text-center">
                <img class="e3fa9175ee d354f8f44f"
                    src="https://t-cf.bstatic.com/design-assets/assets/v3.134.0/illustrations-traveller/TripsGlobe.png"
                    srcset="https://t-cf.bstatic.com/design-assets/assets/v3.134.0/illustrations-traveller/TripsGlobe@2x.png 2x"
                    alt="" role="presentation" loading="lazy">
                <h3 class="text-2xl font-semibold text-gray-700 mb-2">{{ __('content.history.content_history') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('content.history.content_history2') }}</p>
            </div>
        @else
            <h2 class="text-xl font-bold text-[#003b95] mb-6">{{ __('content.history.title_history') }}</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow-lg overflow-hidden">
                    <thead>
                        <tr class="bg-[#003b95] text-white text-lg">
                            <th class="py-3 px-6 text-left">{{ __('content.history.destination_name') }}</th>
                            <th class="py-3 px-6 text-left">{{ __('content.history.check_in') }}</th>
                            <th class="py-3 px-6 text-left">{{ __('content.history.check_out') }}</th>
                            <th class="py-3 px-6 text-left">{{ __('content.history.price') }}</th>
                           
                            <th class="py-3 px-6 text-center">{{ __('content.manage-booking.status') }}</th>
                            <th class="py-3 px-6 text-center">{{ __('content.history.details') }}</th>
                            <th class="py-3 px-6 text-center">{{ __('content.history.cancel1') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="text-gray-700 dark:text-gray-100">
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{ $booking->room_details[0]['destinations_name'] ?? 'N/A' }}
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{ \Carbon\Carbon::parse($booking->check_in)->format('d/m/Y H:i') }}
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{ \Carbon\Carbon::parse($booking->check_out)->format('d/m/Y H:i') }}
                                </td>
                                <td
                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
                                    {{ number_format($booking->total_price, 0, ',', '.') }} VND
                                </td>
                                
                                <td class="py-4 px-6 text-center">
                                    @if ($booking->roomListBookings->first()->status === COMPLETED)
                                        <button type='button'
                                            class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-green-900 uppercase rounded-md select-none whitespace-nowrap bg-green-500/20'>
                                            <span class=''>{{ __('content.manage-booking.completed') }}</span>
                                        </button>
                                    @elseif($booking->roomListBookings->first()->status === ACTIVE)
                                        <button type='button'
                                            class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-[#eda515] uppercase rounded-md select-none whitespace-nowrap bg-[#eda515]/20'>
                                            <span class=''>{{ __('content.manage-booking.active') }}</span>
                                        </button>
                                    @else
                                        <button type='button'
                                            class='relative text-center grid items-center px-2 py-1 font-sans text-xs font-bold text-red-900 uppercase rounded-md select-none whitespace-nowrap bg-red-500/20'>
                                            <span class=''>{{ __('content.manage-booking.canceled') }}</span>
                                        </button>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('booking.invoice', $booking->id) }}"
                                        class="text-[#003b95] font-semibold hover:underline">{{ __('content.history.show_invoice') }}</a>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if ($booking->roomListBookings->contains('status', 'canceled'))
                                    @elseif($booking->roomListBookings->contains('status', 'completed'))
                                    @else
                                        <button type="button"
                                            class="cancel-booking-btn text-red-600 font-semibold hover:underline"
                                            data-id="{{ $booking->id }}">
                                            {{ __('content.history.cancel') }}
                                        </button>
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.cancel-booking-btn', function() {
                const bookingId = $(this).data('id'); // Lấy ID đặt chỗ
                const spinner = $(`#spinner-${bookingId}`); // Spinner loading

                Swal.fire({
                    title: '{{ __('content.history.title_request1') }}',
                    text: '{{ __('content.history.text_request1') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('content.history.confirm') }}',
                    cancelButtonText: '{{ __('content.history.cancel_request') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Hiển thị loading trong SweetAlert
                        Swal.fire({
                            title: '{{ __('content.history.loading') }}',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Gửi yêu cầu hủy qua AJAX
                        $.ajax({
                            url: `/users/booking/${bookingId}/cancel`,
                            type: 'POST', // Đổi thành POST
                            data: {
                                _method: 'DELETE', // Thêm trường này để spoof phương thức DELETE
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ __('content.history.success') }}',
                                    text: '{{ __('content.history.text_request2') }}',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location
                                        .reload(); // Reload trang sau khi hủy thành công
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: '{{ __('content.history.error') }}',
                                    text: xhr.responseJSON?.message,
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    @include('client.layouts.footer')
@endsection
