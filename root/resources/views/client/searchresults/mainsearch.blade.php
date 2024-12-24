@extends('client.layouts.master-layout')
@section('content')
    @include('client.searchresults.layouts-search.header')
    <main>

        <div class="w-[1024px] mx-auto max-w-full my-10">
            @include('client.searchresults.layouts-search.navsearch')
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-7">
                @if ($hotels->isNotEmpty())
                    <!-- Chỉ hiển thị sidebar nếu có kết quả tìm kiếm -->
                    @include('client.searchresults.layouts-search.sidebarsearch')
                @endif

                <!-- Hiển thị danh sách khách sạn -->
                @include('client.searchresults.layouts-search.list-item', [
                    'hotels' => $hotels,
                    'locationName' => $locationName, // Truyền biến locationName vào view
                ])
            </div>
        </div>
    </main>
    @include('client.layouts.footer')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Bắt sự kiện thay đổi trên tất cả các input lọc với class 'filter-input'
            $('.filter-input').on('change', function() {
                let location = "{{ isset($locationName) ? $locationName : request('location') }}";

                let minPrice = $('#labels-range-input').val();
                let maxPrice = $('#labels-range-input').attr('max');
                let categories = [];
                let ratings = [];
                let convenients = [];
                let variants = [];
                // // Thêm các lệnh console.log để kiểm tra giá trị
                // console.log("Location:", location);
                // console.log("Min Price:", minPrice);
                // console.log("Max Price:", maxPrice);
                // console.log("Categories:", categories);
                // console.log("Ratings:", ratings);
                // console.log("Convenients:", convenients);
                // console.log("Variants:", variants);

                // Thu thập các checkbox được chọn
                $('input[id^="category-"]:checked').each(function() {
                    categories.push($(this).attr('id').split('-')[1]);
                });
                $('input[id^="rating-"]:checked').each(function() {
                    ratings.push($(this).attr('id').split('-')[1]);
                });
                $('input[id^="convenient-"]:checked').each(function() {
                    convenients.push($(this).attr('id').split('-')[1]);
                });
                $('input[id^="variant-"]:checked').each(function() {
                    variants.push($(this).attr('id').split('-')[1]);
                });

                // AJAX request để lọc khách sạn
                $.ajax({
                    url: '{{ route('client.filter.hotels') }}',
                    method: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        location: location,
                        min_price: minPrice,
                        max_price: maxPrice,
                        categories: categories,
                        ratings: ratings,
                        convenients: convenients,
                        variants: variants,
                        check_in: '{{ request('check_in') }}',
                        check_out: '{{ request('check_out') }}',
                        rooms: '{{ request('rooms') }}',
                        people_old: '{{ request('people_old') }}',

                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.html) {
                            $('.list-item-container').html(response.html);
                        } else {
                            console.error("Không có HTML trả về");
                        }
                    },
                    error: function(xhr) {
                        console.error("Lỗi khi lọc khách sạn: ", xhr);
                    }
                });
            });
            let rangeInput = $('#labels-range-input');
            let priceDisplay = $('#price-range-display');

            // Hàm cập nhật giá trị hiển thị
            function updatePriceDisplay() {
                let value = rangeInput.val();
                let maxPrice = rangeInput.attr('max');
                priceDisplay.text('VND ' + new Intl.NumberFormat('vi-VN').format(value) + ' - VND ' + new Intl
                    .NumberFormat('vi-VN').format(maxPrice));
            }

            // Gọi hàm khi có sự kiện input
            rangeInput.on('input', function() {
                updatePriceDisplay();
            });

            // Cập nhật khi trang tải để thiết lập giá trị ban đầu
            updatePriceDisplay();
        });
    </script>
@endpush
