<style>
    .destination .carousel-wrapper {
        overflow: hidden;
        position: relative;
        padding-left: 8px;
        padding-right: 8px;
    }

    .destination #carousel-container-4 {
        display: flex;
        transition: transform 0.5s ease;
        width: calc(100% + 16px);
    }

    .destination .carousel-item {
        flex: 0 0 calc(25% - 16px);
        margin-right: 16px;
        transition: transform 0.3s;
    }

    .destination .carousel-item:hover {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .destination .carousel-item {
            flex: 0 0 calc(50% - 16px);
        }
    }
</style>


<div class="w-[1024px] mx-auto max-w-full destination">
    <!-- Nhà ở mà khách yêu thích -->
    <div class="h-full relative mx-0 lg:mx-5">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold py-5 text-start">
                {{ __('content.favorites_destination.favorites_destination') }}</h1>
            <div class="relative">
                <div class="carousel-wrapper">
                    <div id="carousel-container-4">
                        @if ($favoriteDestinations->isEmpty())
                            <div class="carousel-item">
                                <div class="bg-white rounded-md overflow-hidden">
                                    <img class="w-full h-48 object-cover transition-transform duration-200"
                                        src="https://placehold.co/400" alt="RosaMAY Hotel Thủ Khoa Huân" />
                                    <div class="p-4">
                                        <h4 class="mt-2 text-lg font-bold">
                                            {{ __('content.favorites_destination.name') }}</h4>
                                        <p class="text-sm text-gray-500">
                                            {{ __('content.favorites_destination.address') }}</p>
                                        <div class="flex items-center mt-2 mb-5">
                                            <div class="rate bg-blue-900 w-8 rounded-md text-center text-white">
                                                {{ __('content.favorites_destination.fake_review') }}</div>
                                            <div class="ml-2 text-xs pt-1">
                                                <p>{{ __('content.favorites_destination.Great') }} - 32
                                                    {{ __('content.favorites_destination.review') }}</p>
                                            </div>
                                        </div>
                                        <div class="price text-sm mt-5 text-right">
                                            <span class="text-xs">{{ __('content.favorites_destination.start') }}</span>
                                            <span class="font-bold">{{ __('content.favorites_destination.money') }}
                                                <span
                                                    id="discounted-price-hanoi">{{ __('content.favorites_destination.fake_money') }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach ($favoriteDestinations as $favorite)
                                <div class="carousel-item pb-[24px]">
                                    <div class="bg-white rounded-md shadow-md overflow-hidden">

                                        @php
                                            // Kiểm tra xem destination có tồn tại không
                                            $destination = $favorite->destination;
                                            $imageUrl = asset('https://placehold.co/400'); // Đặt URL mặc định

                                            if ($destination) {
                                                // Kiểm tra xem có images không
                                                $image = $destination->images->first();
                                                $imageUrl = !empty($image)
                                                    ? asset('storage/' . $image->image)
                                                    : asset('https://placehold.co/400'); // Đặt lại URL mặc định nếu không có hình ảnh
                                            }
                                        @endphp
                                        <a href="{{ route('hotel-details', ['id' => $destination->id]) }}">
                                            <img class="w-full h-48 object-cover transition-transform duration-200"
                                                src="{{ $imageUrl }}"
                                                alt="{{ $destination->name ?? 'Destination' }}" />

                                            <div class="p-4">
                                                <h4 class="mt-2 text-lg line-clamp-1 font-bold">
                                                    {{ $destination->name ?? 'Unknown Destination' }}</h4>
                                                <p class="text-[12px] text-gray-500 line-clamp-1">
                                                    {{ $destination->detailed_address ?? 'No address available' }}</p>
                                                <div class="flex items-center mt-2 mb-5">
                                                    <div
                                                        class="rate bg-blue-900 w-[24px] h-[24px] flex justify-center items-center text-[12px] rounded-md text-white">
                                                        {{ number_format($favorite->average_rating, 1) }}</div>
                                                    <div class="ml-2 text-xs pt-1">
                                                        <p>{{ __('content.favorites_destination.Great') }} -
                                                            {{ $favorite->comments_count }}
                                                            {{ __('content.favorites_destination.review') }}</p>
                                                    </div>
                                                </div>
                                                <div class="price text-sm mt-5 text-right">
                                                    <span
                                                        class="text-xs">{{ __('content.favorites_destination.start') }}</span>
                                                    <span
                                                        class="font-bold">{{ __('content.favorites_destination.money') }}
                                                        <span
                                                            id="discounted-price-hanoi">{{ $favorite->lowest_price ? number_format($favorite->lowest_price) : 'N/A' }}</span></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <button id="prev-button-4"
                    class="absolute top-1/2 left-[-20px] transform -translate-y-1/2 bg-white text-black shadow-md rounded-full px-4 py-2">
                    <i class="fa-solid fa-angle-left"></i>
                </button>
                <button id="next-button-4"
                    class="absolute top-1/2 right-[-20px] transform -translate-y-1/2 bg-white text-black shadow-md rounded-full px-4 py-2">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('carousel-container-4');
        const prevButton = document.getElementById('prev-button-4');
        const nextButton = document.getElementById('next-button-4');
        const items = Array.from(container.children);
        let currentIndex = 0;

        function updateCarousel() {
            if (items.length === 0) return;

            const itemWidth = items[0].offsetWidth + 16;
            const visibleItems = window.innerWidth < 768 ? 2 : 4;
            const offset = -currentIndex * itemWidth;
            container.style.transform = `translateX(${offset}px)`;

            prevButton.disabled = currentIndex === 0;
            nextButton.disabled = currentIndex >= items.length - visibleItems;
        }

        function showNextItem() {
            const visibleItems = window.innerWidth < 768 ? 2 : 4;
            if (currentIndex < items.length - visibleItems) {
                currentIndex++;
                updateCarousel();
            }
        }

        function showPrevItem() {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        }

        nextButton.addEventListener('click', showNextItem);
        prevButton.addEventListener('click', showPrevItem);

        updateCarousel();

        window.addEventListener('resize', updateCarousel);
    });
</script>
