onMounted(() => {
  const carouselInner = document.getElementById("carousel-1-inner-6");
  const prevButton = document.getElementById("prev1-6");
  const nextButton = document.getElementById("next1-6");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth;
  const visibleItemsCount = 6; // Số lượng item hiển thị cùng lúc
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;

    // Ẩn/Hiện các nút điều hướng
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display =
      currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
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

  nextButton.addEventListener("click", showNextItem);
  prevButton.addEventListener("click", showPrevItem);

  updateCarousel();
});

onMounted(() => {
  const carouselInner = document.getElementById("carousel-2-inner-4");
  const prevButton = document.getElementById("prev2-4");
  const nextButton = document.getElementById("next2-4");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth; // Lấy chiều rộng của một item
  const visibleItemsCount = 4; // Số lượng item hiển thị cùng lúc
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;

    // Ẩn/Hiện các nút điều hướng
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display =
      currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
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

  nextButton.addEventListener("click", showNextItem);
  prevButton.addEventListener("click", showPrevItem);

  // Cập nhật trạng thái nút khi tải trang
  updateCarousel();
});

onMounted(() => {
  const carouselInner = document.getElementById("carousel-3-inner-4");
  const prevButton = document.getElementById("prev3-4");
  const nextButton = document.getElementById("next3-4");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth; // Lấy chiều rộng của một item
  const visibleItemsCount = 4; // Số lượng item hiển thị cùng lúc
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;

    // Ẩn/Hiện các nút điều hướng
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display =
      currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
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

  nextButton.addEventListener("click", showNextItem);
  prevButton.addEventListener("click", showPrevItem);

  // Cập nhật trạng thái nút khi tải trang
  updateCarousel();
});

onMounted(() => {
  const carouselInner = document.getElementById("carousel-4-inner-6");
  const prevButton = document.getElementById("prev4-6"); // Lưu ý: ID này trùng với carousel cũ. Bạn có thể đổi ID thành một cái mới như 'prev-6'.
  const nextButton = document.getElementById("next4-6"); // Lưu ý: ID này trùng với carousel cũ. Bạn có thể đổi ID thành một cái mới như 'next-6'.
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth; // Lấy chiều rộng của một item
  const visibleItemsCount = 6; // Số lượng item hiển thị cùng lúc
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;

    // Ẩn/Hiện các nút điều hướng
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display =
      currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
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

  nextButton.addEventListener("click", showNextItem);
  prevButton.addEventListener("click", showPrevItem);

  // Cập nhật trạng thái nút khi tải trang
  updateCarousel();
});

onMounted(() => {
  const carouselInner = document.getElementById("carousel-5-inner-4");
  const prevButton = document.getElementById("prev5-4");
  const nextButton = document.getElementById("next5-4");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth; // Lấy chiều rộng của một item
  const visibleItemsCount = 4; // Số lượng item hiển thị cùng lúc
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;

    // Ẩn/Hiện các nút điều hướng
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display =
      currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
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

  nextButton.addEventListener("click", showNextItem);
  prevButton.addEventListener("click", showPrevItem);

  // Cập nhật trạng thái nút khi tải trang
  updateCarousel();
});

onMounted(() => {
  const carouselInner = document.getElementById("carousel-6-inner-4");
  const prevButton = document.getElementById("prev6-4");
  const nextButton = document.getElementById("next6-4");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth; // Lấy chiều rộng của một item
  const visibleItemsCount = 4; // Số lượng item hiển thị cùng lúc
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;

    // Ẩn/Hiện các nút điều hướng
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display =
      currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
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

  nextButton.addEventListener("click", showNextItem);
  prevButton.addEventListener("click", showPrevItem);

  // Cập nhật trạng thái nút khi tải trang
  updateCarousel();
});