@extends('admin.layouts.master-layout')
@section('content')
    <div class="container mx-auto p-6">
        <form action="{{ route('admin.dashboard') }}" method="GET" class="mb-4 bg-white p-4 rounded-lg shadow-md">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-2">
                <div class="flex flex-col">
                    <label for="destination_id"
                        class="text-sm font-medium mb-1">{{ __('content.analytics.select_hotel') }}</label>
                    <select name="destination_id" id="destination_id"
                        class="form-select p-1 border border-gray-300 rounded-md text-sm">
                        <option value="">{{ __('content.analytics.all') }}</option>
                        @if (!isset($hotel))
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}"
                                    {{ request('destination_id') == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="">{{ __('content.analytics.no_hotel') }}</option>
                        @endif
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="start_date" class="text-sm font-medium mb-1">{{ __('content.analytics.from_date') }}</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                        class="form-input p-1 border border-gray-300 rounded-md text-sm">
                </div>
                <div class="flex flex-col">
                    <label for="end_date" class="text-sm font-medium mb-1">{{ __('content.analytics.to_date') }}</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                        class="form-input p-1 border border-gray-300 rounded-md text-sm">
                </div>
                <div class="flex flex-col">
                    <label for="date_range"
                        class="text-sm font-medium mb-1">{{ __('content.analytics.date_range') }}</label>
                    <select id="date_range" class="form-select p-1 border border-gray-300 rounded-md text-sm"
                        onchange="setDateRange()">
                        <option value="">{{ __('content.analytics.date_range') }}</option>
                        <option value="today">{{ __('content.analytics.today') }}</option>
                        <option value="7">{{ __('content.analytics.7_days_ago') }}</option>
                        <option value="15">{{ __('content.analytics.15_days_ago') }}</option>
                        <option value="30">{{ __('content.analytics.30_days_ago') }}</option>
                        <option value="reset">{{ __('content.analytics.reset') }}</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="btn btn-primary w-full py-1 px-2 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 text-sm">
                        {{ __('content.analytics.filter') }}
                    </button>
                </div>
            </div>
        </form>

        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-2"> {{ __('content.analytics.total_bookings') }}</h2>
                <p class="text-3xl font-bold" id="totalBookings">{{ number_format($totalBookings ?? 0) }}</p>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-2">{{ __('content.analytics.revenue') }}</h2>
                <p class="text-3xl font-bold" id="currentRevenue">{{ number_format($currentRevenue ?? 0) }} VND</p>
            </div>

            @if (request('destination_id'))
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold mb-2">{{ __('content.analytics.total_rooms') }}</h2>
                    <p class="text-3xl font-bold" id="totalRooms">{{ number_format($totalRooms ?? 0) }}</p>
                </div>

                @if (request('start_date') && request('start_date') === request('end_date'))
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-2">{{ __('content.analytics.available_rooms') }}</h2>
                        <p class="text-3xl font-bold" id="availableRooms">{{ $availableRooms ?? 'N/A' }}</p>
                    </div>
                @endif
            @endif
        </div>

        <!-- Monthly Revenue and Bookings Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">{{ __('content.analytics.monthly_revenue') }}</h2>
                <canvas id="revenueChart"></canvas>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">{{ __('content.analytics.monthly_bookings') }}</h2>
                <canvas id="bookingChart"></canvas>
            </div>
        </div>

        <!-- Booking Details Table -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">{{ __('content.analytics.my_hotels_revenue') }}</h2>
            <canvas id="myHotelsRevenueChart"></canvas>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function setDateRange() {
            const range = document.getElementById('date_range').value;
            const endDate = new Date();
            const startDate = new Date();

            if (range === "today") {
                const formatDate = (date) => date.toISOString().split('T')[0];
                document.getElementById('start_date').value = formatDate(endDate);
                document.getElementById('end_date').value = formatDate(endDate);
            } else if (range === "7") {
                startDate.setDate(endDate.getDate() - 7);
            } else if (range === "15") {
                startDate.setDate(endDate.getDate() - 15);
            } else if (range === "30") {
                startDate.setMonth(endDate.getMonth() - 1);
            } else if (range === "reset") {
                document.getElementById('start_date').value = "";
                document.getElementById('end_date').value = "";
                document.getElementById('date_range').value = "";
                return;
            } else {
                return;
            }

            const formatDate = (date) => date.toISOString().split('T')[0];
            document.getElementById('start_date').value = formatDate(startDate);
            document.getElementById('end_date').value = formatDate(endDate);
        }

        document.addEventListener('DOMContentLoaded', function() {

            const revenueData = @json(array_values($monthlyRevenue));
            const bookingData = @json(array_values($monthlyBookings));
            const labels = @json(array_keys($monthlyRevenue));
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            const revenue = "{{ __('content.analytics.revenue') }}";
            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: revenue,
                        data: revenueData,
                        borderColor: '#4CAF50',
                        fill: false
                    }]
                }
            });

            const ctxBooking = document.getElementById('bookingChart').getContext('2d');
            const booking = "{{ __('content.analytics.booking') }}";
            new Chart(ctxBooking, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: booking,
                        data: bookingData,
                        backgroundColor: '#FF5733'
                    }]
                }
            });

            // Lấy dữ liệu tên khách sạn và doanh thu
            const hotelNames = @json($topRevenueHotels->pluck('hotel_name'));
            const hotelRevenues = @json($topRevenueHotels->pluck('total_revenue'));
            const revenueLabel = "{{ __('content.analytics.revenue_label') }}";
            const ctxMyHotelsRevenue = document.getElementById('myHotelsRevenueChart').getContext('2d');
            new Chart(ctxMyHotelsRevenue, {
                type: 'bar',
                data: {
                    labels: hotelNames,
                    datasets: [{
                        label: revenueLabel,
                        data: hotelRevenues,
                        backgroundColor: '#42A5F5'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
