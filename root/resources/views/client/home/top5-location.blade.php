<div class="mt-[35px]">
    <!-- Điểm đến đang thịnh hành -->
    <div class="max-w-[1024px] mx-auto categories mt-6">
        <div class="h-full relative mx-0 lg:mx-5">
            <!-- top 5 -->
            <div class="trend-location">
                <h1 class="text-3xl font-bold py-6 text-gray-800">{{ __('content.top5_location.locationRank') }}</h1>
                <p class="text-lg text-gray-600 mb-6">{{ __('content.top5_location.select_location') }}</p>

                @if ($top5Location->isEmpty())
                    <div
                        class="w-full h-64 flex items-center justify-center bg-gray-100 rounded-md shadow-lg cursor-pointer border border-gray-300 hover:border-orange-500 transition-all">
                        <div class="flex flex-col md:flex-row gap-6 mb-6">
                            <div
                                class="w-full h-80 relative rounded-md overflow-hidden shadow-lg cursor-pointer border border-gray-200 hover:border-orange-500 transition-all">
                                <a href="#" class="block h-full">
                                    <img src="https://placehold.co/600" alt="https://placehold.co/400"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                                    <div
                                        class="absolute top-0 left-0 p-4 text-white w-full flex items-center justify-between">
                                        <span
                                            class="font-bold text-lg uppercase">{{ __('content.top5_location.top5') }}</span>
                                        <img src="{{ asset('image/flag-vn.png') }}" alt="Flag"
                                            class="w-8 shadow-lg" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Hàng trên: 2 ảnh lớn -->
                    <div class="flex flex-col md:flex-row gap-6 mb-6">
                        @foreach ($top5Location->take(2) as $location)
                            <div
                                class="w-full md:w-1/2 h-80 relative rounded-md overflow-hidden shadow-lg cursor-pointer border border-gray-200 hover:border-orange-500 transition-all">
                                @php
                                    $searchUrl = route('client.search', [
                                        'location' => $location->name,
                                        'check_in' => now()->format('Y-m-d'),
                                        'check_out' => now()->addDay()->format('Y-m-d'),
                                        'people_old'=>2,
                                        'rooms' => 1,
                                    ]);
                                @endphp
                                <a href="{{ $searchUrl }}" class="block h-full">
                                    @php
                                        $image = $location->images->first();
                                    @endphp
                                    @if ($image)
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $location->name }} "
                                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                                        <div
                                            class="absolute top-0 left-0 p-4 text-white w-full flex items-center justify-between">
                                            <span class="font-bold text-lg uppercase">{{ $location->name }}</span>
                                            <img src="{{ asset('image/flag-vn.png') }}" alt="Flag"
                                                class="w-8 shadow-lg" />
                                        </div>
                                    @else
                                        <img src="https://placehold.co/600" alt="https://placehold.co/600"
                                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                                        <div
                                            class="absolute top-0 left-0 p-4 text-white w-full flex items-center justify-between">
                                            <span
                                                class="font-bold text-lg uppercase">{{ __('content.top5_location.top5') }}</span>
                                            <img src="{{ asset('image/flag-vn.png') }}" alt="Flag"
                                                class="w-8 shadow-lg" />
                                        </div>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Hàng dưới: 3 ảnh nhỏ -->
                    <div class="flex flex-col md:flex-row gap-4">
                        @foreach ($top5Location->slice(2, 3) as $location)
                            <div
                                class="w-full md:w-1/3 h-64 relative rounded-md overflow-hidden shadow-lg cursor-pointer border border-gray-200 hover:border-orange-500 transition-all">
                                @php
                                    $searchUrl = route('client.search', [
                                        'location' => $location->name,
                                        'check_in' => now()->format('Y-m-d'),
                                        'check_out' => now()->addDay()->format('Y-m-d'),
                                        'people_old'=>2,
                                        'rooms' => 1,
                                    ]);
                                @endphp
                                <a href="{{ $searchUrl }}" class="block h-full">
                                    @php
                                        $image = $location->images->first();
                                    @endphp
                                    @if ($image)
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $location->name }} "
                                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                                        <div
                                            class="absolute top-0 left-0 p-4 text-white w-full flex items-center justify-between">
                                            <span class="font-bold text-lg uppercase">{{ $location->name }}</span>
                                            <img src="{{ asset('image/flag-vn.png') }}" alt="Flag"
                                                class="w-8 shadow-lg" />
                                        </div>
                                    @else
                                        <img src="https://placehold.co/600" alt="https://placehold.co/600"
                                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                                        <div
                                            class="absolute top-0 left-0 p-4 text-white w-full flex items-center justify-between">
                                            <span
                                                class="font-bold text-lg uppercase">{{ __('content.top5_location.top5') }}</span>
                                            <img src="{{ asset('image/flag-vn.png') }}" alt="Flag"
                                                class="w-8 shadow-lg" />
                                        </div>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
