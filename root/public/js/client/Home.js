// Carousel 1
(function() {
  const carouselInner = document.getElementById("carousel-1-inner-6");
  const prevButton = document.getElementById("prev1-6");
  const nextButton = document.getElementById("next1-6");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth;
  const visibleItemsCount = 6;
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display = currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
  }

  prevButton.addEventListener("click", () => {
    if (currentIndex > 0) currentIndex--;
    updateCarousel();
  });

  nextButton.addEventListener("click", () => {
    if (currentIndex < itemCount - visibleItemsCount) currentIndex++;
    updateCarousel();
  });

  updateCarousel();
})();

// Carousel 2
(function() {
  const carouselInner = document.getElementById("carousel-2-inner-4");
  const prevButton = document.getElementById("prev2-4");
  const nextButton = document.getElementById("next2-4");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth;
  const visibleItemsCount = 4;
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display = currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
  }

  prevButton.addEventListener("click", () => {
    if (currentIndex > 0) currentIndex--;
    updateCarousel();
  });

  nextButton.addEventListener("click", () => {
    if (currentIndex < itemCount - visibleItemsCount) currentIndex++;
    updateCarousel();
  });

  updateCarousel();
})();

// Carousel 3
(function() {
  const carouselInner = document.getElementById("carousel-3-inner-4");
  const prevButton = document.getElementById("prev3-4");
  const nextButton = document.getElementById("next3-4");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth;
  const visibleItemsCount = 4;
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display = currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
  }

  prevButton.addEventListener("click", () => {
    if (currentIndex > 0) currentIndex--;
    updateCarousel();
  });

  nextButton.addEventListener("click", () => {
    if (currentIndex < itemCount - visibleItemsCount) currentIndex++;
    updateCarousel();
  });

  updateCarousel();
})();

// Carousel 4
(function() {
  const carouselInner = document.getElementById("carousel-4-inner-6");
  const prevButton = document.getElementById("prev4-6");
  const nextButton = document.getElementById("next4-6");
  const items = Array.from(carouselInner.children);
  const itemCount = items.length;
  const itemWidth = items[0].offsetWidth;
  const visibleItemsCount = 6;
  let currentIndex = 0;

  function updateCarousel() {
    const offset = -currentIndex * itemWidth;
    carouselInner.style.transform = `translateX(${offset}px)`;
    prevButton.style.display = currentIndex === 0 ? "none" : "block";
    nextButton.style.display = currentIndex >= itemCount - visibleItemsCount ? "none" : "block";
  }

  prevButton.addEventListener("click", () => {
    if (currentIndex > 0) currentIndex--;
    updateCarousel();
  });

  nextButton.addEventListener("click", () => {
    if (currentIndex < itemCount - visibleItemsCount) currentIndex++;
    updateCarousel();
  });

  updateCarousel();
})();

// Apply similar changes for other carousels (5, 6)
