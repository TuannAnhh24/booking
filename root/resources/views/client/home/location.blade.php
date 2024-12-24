<style>
    .locations .carousel-wrapper {
        overflow: hidden;
    }

    .locations #carousel-container-2 {
        display: flex;
        transition: transform 0.5s ease;
        width: calc(100% + 16px);
    }

    .locations .carousel-item {
        flex: 0 0 calc(16.66% - 16px);
        margin-right: 16px;
    }

    @media (max-width: 1024px) {
        .locations .carousel-item {
            flex: 0 0 calc(33.33% - 16px);
        }
    }

    @media (max-width: 768px) {
        .locations .carousel-item {
            flex: 0 0 calc(50% - 16px);
        }
    }

    @media (max-width: 480px) {
        .locations .carousel-item {
            flex: 0 0 calc(100% - 16px);
        }
    }
</style>


<div>
    <div class="w-[1024px] mx-auto max-w-full locations mt-[35px]">
        <div class="h-full lg:mx-5">
            <!-- Categori -->
            <div class="container mx-auto">
                <h1 class="text-2xl font-bold pt-5 text-start">{{ __('content.location_home.search_VN') }}</h1>
                <p class="py-2">{{ __('content.location_home.location_popular') }}</p>
                <!-- Carousel Section -->
                <div class="relative">
                    <div class="carousel-wrapper">
                        <div id="carousel-container-2">
                            <!-- Carousel Items -->
                            @if($locations->isEmpty())
                            <div class="carousel-item">
                                <div class="bg-white rounded-md">
                                    <a href=""><img class="w-full h-32 object-cover rounded-md shadow-md" src="https://placehold.co/400" alt="https://placehold.co/400" /></a>
                                    <h2 class="mt-2 text-sm font-bold text-start">{{ __('content.location_home.locations') }}</h2>
                                </div>
                            </div>
                            @else
                            @foreach ($locations as $location)
                            <div class="carousel-item">
                                <div class="bg-white rounded-md">
                                    @php
                                    $image = $location->images->first();
                                    $searchUrl = route('client.search', ['location' => $location->name, 'check_in' => now()->format('Y-m-d'), 'check_out' => now()->addDay()->format('Y-m-d'), 'people_old' =>2 , 'rooms' => 1]);
                                    @endphp
                                    @if(!$image)
                                    <a href="{{ $searchUrl }}"><img class="w-full h-32 object-cover rounded-md shadow-md" src="https://placehold.co/400" alt="{{ $location->name }}" /></a>
                                    @else
                                    <a href="{{ $searchUrl }}"><img class="w-full h-32 object-cover rounded-md shadow-md" src="{{ asset('storage/' . $image->image) }}" alt="{{ $location->name }}" /></a>
                                    @endif
                                    <h2 class="mt-2 text-sm line-clamp-1 font-bold text-start">{{ $location->name }}</h2>
                                    <p class="text-gray-600 text-xs">{{ $location->destinations_count }} {{ __('content.location_home.accommodation') }} </p>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- Previous Button -->
                    <button id="prev-button-2" class="absolute top-1/2 left-[-20px] transform -translate-y-1/2 bg-white shadow-lg rounded-full w-10 h-10 text-black hover:bg-gray-100" disabled>
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                    <!-- Next Button -->
                    <button id="next-button-2" class="absolute top-1/2 right-[-20px] transform -translate-y-1/2 bg-white shadow-lg rounded-full w-10 h-10 text-black hover:bg-gray-100">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('carousel-container-2');
        const prevButton = document.getElementById('prev-button-2');
        const nextButton = document.getElementById('next-button-2');
        const items = Array.from(container.children);
        let currentIndex = 0;
        let visibleItems = getVisibleItems();

        function getVisibleItems() {
            const width = window.innerWidth;
            if (width <= 480) return 1;
            if (width <= 768) return 2;
            if (width <= 1024) return 3;
            return 6;
        }

        function updateCarousel() {
            if (items.length === 0) return;

            const itemWidth = items[0].offsetWidth + parseInt(getComputedStyle(items[0]).marginRight);
            const offset = -currentIndex * itemWidth;
            container.style.transform = `translateX(${offset}px)`;

            prevButton.disabled = currentIndex === 0;
            nextButton.disabled = currentIndex >= items.length - visibleItems;
        }

        function showNextItem() {
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

        window.addEventListener('resize', () => {
            visibleItems = getVisibleItems();
            currentIndex = Math.min(currentIndex, items.length - visibleItems); // Đảm bảo không vượt quá số item
            updateCarousel();
        });

        window.addEventListener('load', updateCarousel);
    });
</script>