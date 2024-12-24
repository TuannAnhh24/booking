<style>
    .characteristic #carousel-container-3 {
        display: flex;
        transition: transform 0.5s ease;
        width: calc(100% + 16px);
        margin-left: 8px;
        margin-right: 8px;
    }

    .characteristic .carousel-item {
        flex: 0 0 calc(16.66% - 16px);
        margin-right: 16px;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .characteristic .carousel-item {
            flex: 0 0 calc(25% - 16px);
            /* 4 items per row */
        }
    }

    @media (max-width: 768px) {
        .characteristic .carousel-item {
            flex: 0 0 calc(50% - 16px);
            /* 2 items per row */
        }
    }

    @media (max-width: 480px) {
        .characteristic .carousel-item {
            flex: 0 0 calc(100% - 16px);
            /* 1 item per row */
        }
    }

    .characteristic-link.active {
        background-color: #f1f5f9;
        color: #3b82f6;
    }
</style>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="/js/app.js"></script>
<div>
    <!-- Lên kế hoạch dễ dàng và nhanh chóng -->
    <div class="w-[1024px] mx-auto max-w-full characteristic mt-[35px]">
        <div class="h-full relative mx-0 lg:mx-5">
            <!-- Charateristic -->
            <div class="container mx-auto">
                <h1 class="text-2xl font-bold pt-5 text-start">{{ __('content.characteristic_home.plan') }}</h1>
                <p class="py-2">{{ __('content.characteristic_home.search') }}</p>
                <!-- Carousel Section -->
                <div class="carousel-wrapper">
                    <ul class="flex  gap-4 py-2 pr-3 flex-wrap lg:flex-nowrap">
                        @if($characteristices->isEmpty())
                        <li class="flex items-center justify-center border hover:bg-slate-100 rounded-full transition duration-300 ease-in-out py-2 px-4">
                            <a href="javascript:void(0)" class="flex items-center text-sm text-gray-700 hover:text-blue-500">
                                {{ __('content.characteristic_home.characteristic') }}
                            </a>
                        </li>
                        @else
                        @foreach ($characteristices as $characteristic)
                        <li class="flex items-center justify-center border hover:bg-slate-100 rounded-full transition duration-300 ease-in-out py-2 px-4 characteristic-item ">
                            <a href="javascript:void(0)"
                                class="flex items-center text-sm text-gray-700 hover:text-blue-500 characteristic-link"
                                data-id="{{ $characteristic->id }}"
                                onclick="loadLocations({{ $characteristic->id }}, this)">
                                {{ $characteristic->name }}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="relative">
                        <div class="overflow-hidden">
                            <div id="carousel-container-3" class="mt-4 ">
                                <!-- Carousel Items -->
                                @if($locations->isEmpty())
                                <div class="carousel-item">
                                    <div class="bg-white rounded-md">
                                        <a href=""><img class="w-full h-32 object-cover rounded-md" src="https://placehold.co/400" alt="No location found" /></a>
                                        <h2 class="mt-2 ml-3 text-sm font-bold text-start">{{ __('content.characteristic_home.no_locations') }}</h2>
                                    </div>
                                </div>
                                @else
                                @foreach ($locations as $location)
                                <div class="carousel-item ">
                                    <div class="bg-white rounded-md">
                                        @php
                                        $image = $location->images->first();
                                        $searchUrl = route('client.search', ['location' => $location->name, 'check_in' => now()->format('Y-m-d'), 'check_out' => now()->addDay()->format('Y-m-d'), 'people_old' =>2, 'rooms' => 1]);
                                        @endphp
                                        @if(!$image)
                                        <a href="{{$searchUrl}}"><img class="w-full h-32 object-cover rounded-md shadow-md" src="https://placehold.co/400" alt="{{ $location->name }}" /></a>
                                        @else
                                        <a href="{{$searchUrl}}"><img class="w-full h-32 object-cover rounded-md shadow-md" src="{{ asset('storage/' . $image->image) }}" alt="{{ $location->name }}" /></a>
                                        @endif
                                        <h2 class="mt-2 text-sm line-clamp-1 font-bold text-start">{{ $location->name }}</h2>
                                        <p class="text-gray-600 text-xs" data-id="{{ $location->id }}" data-code="{{ $location->code }}"> {{ __('content.characteristic_home.distance') }} </p>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- Previous Button -->
                        <button id="prev-button-3" class="absolute top-1/2 left-[-20px] transform -translate-y-1/2 bg-white shadow-md rounded-full w-10 h-10 text-black hover:bg-gray-100" disabled>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <!-- Next Button -->
                        <button id="next-button-3" class="absolute top-1/2 right-[-20px] transform -translate-y-1/2 bg-white shadow-md rounded-full w-10 h-10 text-black hover:bg-gray-100">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('carousel-container-3');
        const prevButton = document.getElementById('prev-button-3');
        const nextButton = document.getElementById('next-button-3');
        const items = Array.from(container.children);
        let currentIndex = 0;

        function updateCarousel() {
            if (items.length === 0) return;

            const containerWidth = container.offsetWidth;
            const visibleItems = Math.floor(containerWidth / (items[0].offsetWidth + 16));
            const maxIndex = items.length - visibleItems;

            const itemWidth = items[0].offsetWidth + 16;
            const offset = -currentIndex * itemWidth;
            container.style.transform = `translateX(${offset}px)`;

            prevButton.disabled = currentIndex === 0;
            nextButton.disabled = currentIndex >= maxIndex;
        }

        window.addEventListener('resize', updateCarousel);

        function showNextItem() {
            if (currentIndex < items.length - 6) {
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

    function loadLocations(characteristicId, clickedElement) {
        document.querySelectorAll('.characteristic-link').forEach(link => {
            link.classList.remove('active');
        });
        clickedElement.classList.add('active');

        const liElement = clickedElement.closest('li');
        document.querySelectorAll('.characteristic-item').forEach(item => {
            item.classList.remove('bg-slate-100');
        });
        liElement.classList.add('bg-slate-100');

        fetch(`/locations-by-characteristic/${characteristicId}`)
            .then(response => response.json())
            .then(data => {
                const carouselContainer = document.getElementById('carousel-container-3');
                carouselContainer.innerHTML = '';

                if (data.length === 0) {
                    carouselContainer.innerHTML = `
                <div class="carousel-item">
                    <div class="bg-white rounded-md">
                        <a href=""><img class="w-full h-32 object-cover rounded-md" src="https://placehold.co/400" alt="{{ __('content.characteristic_home.no_locations') }}"/></a>
                        <h2 class="mt-2 ml-3 text-sm font-bold text-start">{{ __('content.characteristic_home.no_locations') }}</h2>
                    </div>
                </div>`;
                } else {
                    data.forEach(location => {
                        const image = location.images.length ?
                            `storage/${location.images[0].image}` :
                            'https://placehold.co/400';

                        carouselContainer.innerHTML += `
                    <div class="carousel-item">
                        <div class="bg-white rounded-md">
                            <a href=""><img class="w-full h-32 object-cover rounded-md" src="${image}" alt="${location.name}"/></a>
                            <h2 class="mt-2 ml-2 text-sm font-bold text-start">${location.name}</h2>
                            <p class="text-gray-600 ml-2 text-xs" data-id="${location.id}" data-code="${location.code}">{{ __('content.characteristic_home.distance') }}</p>
                        </div>
                    </div>`;
                    });
                }
                calculateAndDisplayDistances();
            })
            .catch(error => console.error('Error fetching locations:', error));
    }

    const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        encrypted: true
    });
    const channel = pusher.subscribe('location-distances');
    channel.bind('App\\Events\\LocationDistanceUpdated', function(data) {
        const resultsDiv = document.getElementById('results');
        resultsDiv.innerHTML = '';
        data.distances.forEach(location => {
            resultsDiv.innerHTML += `<p>{{ __('content.characteristic_home.long_distance') }} ${location.name}: ${location.distance.toFixed(2)} {{ __('content.characteristic_home.km') }}</p>`;
        });
    });

    function calculateAndDisplayDistances() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                console.log(lat);
                console.log(lng);



                fetch('/api-locations')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(locationData => {
                        // console.log('Location data:', locationData); get location all
                        const locationsInApi = locationData.data;
                        const distanceElements = document.querySelectorAll('[data-id][data-code]');

                        const locationMap = {};
                        locationsInApi.forEach(location => {
                            if (location.id) {
                                locationMap[location.id.toString()] = location;
                                // console.log(location);
                            }
                        });
                        // console.log('Location Map:', locationMap);
                        distanceElements.forEach(element => {
                            const locationCode = element.getAttribute('data-code');
                            // console.log(locationCode);
                            const formattedLocationCode = locationCode.padStart(2, '0');
                            // console.log(formattedLocationCode); 
                            const location = locationMap[formattedLocationCode];
                            // console.log(location);           
                            if (location) {
                                const distance = calculateDistance(lat, lng, parseFloat(location.latitude), parseFloat(location.longitude));
                                console.log(`Distance to ${location.name}:`, distance);
                                element.innerHTML = `{{ __('content.characteristic_home.long_distance') }} ${distance.toFixed(2)} {{ __('content.characteristic_home.km') }}`;
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching locations:', error));
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    }
    calculateAndDisplayDistances();

    function calculateDistance(lat1, lng1, lat2, lng2) {
        const earthRadius = 6371;
        const dLat = deg2rad(lat2 - lat1);
        const dLng = deg2rad(lng2 - lng1);
        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLng / 2) * Math.sin(dLng / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return earthRadius * c;
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }
</script>