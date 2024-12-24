onMounted(() => {
    const carouselInner = document.getElementById('carousel-1-inner-6');
    const prevButton = document.getElementById('prev1-6');
    const nextButton = document.getElementById('next1-6');
    const items = Array.from(carouselInner.children);
    const itemCount = items.length;
    const itemWidth = items[0].offsetWidth;
    const visibleItemsCount = 6; // Số lượng item hiển thị cùng lúc
    let currentIndex = 0;

    function updateCarousel() {
        const offset = -currentIndex * itemWidth;
        carouselInner.style.transform = `translateX(${offset}px)`;

        // Ẩn/Hiện các nút điều hướng
        prevButton.style.display = currentIndex === 0 ? 'none' : 'block';
        nextButton.style.display = currentIndex >= itemCount - visibleItemsCount ? 'none' : 'block';
    }

    function showNextItem() {
        if (currentIndex < itemCount - visibleItemsCount) {
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
});