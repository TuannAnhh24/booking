@extends('client.layouts.master-layout')
@section('content')
    @include('client.layouts.header')
    @include('client.home.banner')
    <div class="w-[1024px] mx-auto max-w-full mt-[50px]">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500 mb-4 ">
            <a href="#" class="hover:underline text-blue-600">{{ __('content.pagehotels.homePage') }}</a> >
            <span class="text-gray-700">{{ __('content.pagehotels.allHotels') }}</span>
        </nav>

        <!-- Hotel List -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if ($hotels && $hotels->isNotEmpty())
                @foreach ($hotels as $hotel)
                    <!-- Hiển thị thông tin khách sạn -->
                    <div class="bg-white p-4 rounded-lg shadow flex items-start">
                        <img src="{{ $hotel->images->isNotEmpty()
                            ? asset('storage/' . $hotel->images->first()->image)
                            : asset('https://via.placeholder.com/100') }}"
                            alt="Hotel Image" class="w-32 h-24 rounded-md object-cover mr-4">
                        <div class="flex-1">
                            <a href="{{ route('hotel-details', ['id' => $hotel->id]) }}">
                                <h2 class="text-lg font-semibold hover:text-blue-600">{{ $hotel->name }}</h2>
                            </a>

                            <p class="text-gray-600 text-xs">
                                {{ $hotel->locations->pluck('name')->join(', ') }}
                            </p>

                            <p class="text-gray-800 font-bold mt-2">
                                @php
                                    // Lấy tất cả giá từ các variants
                                    $prices = $hotel->rooms->flatMap(function ($room) {
                                        return $room->variants->pluck('pivot.price_per_night');
                                    });
                                    $cheapestPrice = $prices->min();
                                @endphp
                            <h1 class="text-black-600">
                                {{ __('content.search.price') }}: <strong>{{ number_format($cheapestPrice, 0, ',', '.') }}
                                    VND</strong>
                            </h1>
                            </p>

                        </div>

                        <div class="flex flex-col">
                            @php
                                $avgRating = number_format($hotel->reviews->avg('rating') ?? 0, 1);
                            @endphp
                            @if ($avgRating > 9)
                                <div class="text-sm font-bold">{{ __('content.search.excellent') }}</div>
                            @elseif($avgRating >= 7)
                                <div class="text-sm font-bold">{{ __('content.search.good') }}</div>
                            @elseif($avgRating >= 5)
                                <div class="text-sm font-bold">{{ __('content.search.average') }}</div>
                            @else
                                <div class="text-sm font-bold">{{ __('content.search.poor') }}</div>
                            @endif
                            <div class="text-xs">
                                {{ $hotel->reviews->first()->review_count ?? 0 }} {{ __('content.search.reviews') }}
                            </div>
                        </div>
                        <div class="">
                            <span
                                class="px-[0.60rem] py-[0.45rem] bg-[#003b95] rounded-t-lg rounded-br-lg text-white text-center font-semibold">
                                {{ number_format($hotel->reviews->avg('rating') ?? 0, 1) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-600">{{ __('content.pagehotels.notfound') }}</p>
            @endif
        </div>
        <div class="mt-5">
            {{ $hotels->links('client.searchresults.layouts-search.pagination') }}
        </div>
    </div>
    @include('client.layouts.footer')
@endsection
