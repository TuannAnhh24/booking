<style>
    .categories .carousel-wrapper {
        overflow-x: hidden;
        overflow-y: visible;
        padding-bottom: 24px;
    }

    .categories #carousel-container {
        display: flex;
        transition: transform 0.5s ease;
        width: calc(100% + 16px);
        margin-left: -8px;
    }

    .categories .carousel-item {
        flex: 0 0 calc(25% - 16px); /* Hiển thị 4 mục trên màn hình lớn */
        margin-right: 16px;
        background-color: white;
    }

    @media (max-width: 1024px) {
        .categories .carousel-item {
            flex: 0 0 calc(33.333% - 16px); /* Hiển thị 3 mục */
        }
    }

    @media (max-width: 768px) {
        .categories .carousel-item {
            flex: 0 0 calc(50% - 16px); /* Hiển thị 2 mục */
        }
    }

    @media (max-width: 480px) {
        .categories .carousel-item {
            flex: 0 0 calc(100% - 16px); /* Hiển thị 1 mục */
        }
    }
</style>


<div class="w-[1024px] mx-auto max-w-full categories mt-[35px] px-0 lg:px-5">
    <!-- Tìm theo loại chỗ nghỉ -->
    <div class="h-full relative mt-[24px]">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold py-5 text-start">{{ __('content.categori_home.search_category') }}</h1>
            <div class="relative">
                <div class="carousel-wrapper">
                    <div id="carousel-container">
                        @if($categories->isEmpty()) 
                            <div class="carousel-item">
                                <div class="bg-white rounded-md shadow-lg">
                                    <a href=""><img class="w-full h-48 object-cover rounded-md" src="https://placehold.co/400" alt="Placeholder"/></a>
                                    <h2 class="mt-2 text-sm font-bold text-start">{{ __('content.categori_home.category') }}</h2>
                                </div>
                            </div>
                        @else
                            @foreach ($categories as $category)
                                <div class="carousel-item">
                                    <div class="bg-white rounded-md">
                                        @php
                                            $image = $category->images->first();
                                        @endphp
                                        <a href="{{ route('categories.hotels', ['id' => $category->id]) }}">
                                            <img class="w-full h-48 object-cover rounded-md shadow-md" src="{{ !empty($image) ? asset('storage/' . $image->image) : 'https://placehold.co/400' }}" alt="{{ $category->name }}"/>
                                        </a>
                                        <h2 class="mt-2 ml-3 text-sm font-bold text-start">{{ $category->name }}</h2>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <button id="prev-button" class="absolute top-1/2 left-[-20px] transform -translate-y-1/2 bg-white shadow-md rounded-full w-10 h-10 text-black hover:bg-gray-100" disabled>
                    <i class="fa-solid fa-angle-left"></i>
                </button>
                <button id="next-button" class="absolute top-1/2 right-[-20px] transform -translate-y-1/2 bg-white shadow-md rounded-full w-10 h-10 text-black hover:bg-gray-100">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('carousel-container');
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const items = Array.from(container.children);
        let currentIndex = 0;
        let visibleItems = calculateVisibleItems(); // Số lượng mục hiển thị

        function calculateVisibleItems() {
            const screenWidth = window.innerWidth;
            if (screenWidth <= 480) return 1; // 1 mục trên màn hình nhỏ
            if (screenWidth <= 768) return 2; // 2 mục trên tablet
            if (screenWidth <= 1024) return 3; // 3 mục trên màn hình medium
            return 4; // 4 mục trên màn hình lớn
        }

        function updateCarousel() {
            if (items.length === 0) return;

            const itemWidth = items[0].offsetWidth + 16; 
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

        // Cập nhật khi thay đổi kích thước màn hình
        window.addEventListener('resize', () => {
            visibleItems = calculateVisibleItems();
            updateCarousel();
        });

        updateCarousel();
    });
</script>

