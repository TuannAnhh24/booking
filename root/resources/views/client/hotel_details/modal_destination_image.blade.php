<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto relative">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6 border-b pb-4">
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl font-semibold">{{ $destination->name }}</h1>
                </div>
                <div class="flex items-center gap-2">
                    <button id="bookNowButton" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{__('content.hotel_detail.book_now')}}</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                @foreach ($destination->images as $index => $image)
                    <div class="{{ $index === 0 ? 'col-span-2 row-span-2' : '' }}">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->description ?? 'Image' }}"
                            class="w-full h-full object-cover rounded-lg openModal transition-transform duration-300 hover:scale-110"
                            onclick="openSlideshow({{ $index }})" />
                    </div>
                @endforeach
            </div>
            <div class="mt-8 space-y-4">
                @foreach ($reviews->sortByDesc('rating')->take(10) as $review)
                    <div class="p-4 border rounded-lg">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="" class="w-full h-full object-cover rounded-full transition-transform duration-300 hover:scale-110" />
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium">{{ $review->user->first_name }}</span>
                                    <span class="text-sm text-gray-600">{{ $review->user->nationality }}</span>
                                </div>
                                <p class="mt-2 text-gray-700">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div id="slideshow" class="fixed inset-0 bg-white bg-opacity-90 z-50 hidden flex items-center justify-center">
    <div class="relative h-[600]">
        @foreach ($destination->images as $index => $image)
            <img class="slideshow-image {{ $index === 0 ? 'active' : 'hidden' }} w-full h-full"
                src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->description ?? 'Slideshow Image' }}" />
        @endforeach
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white" id="slideCounter">1 /
            {{ $destination->images->count() }}</div>
    </div>
    <button id="closeSlideshowBtn" class="absolute top-4 right-4 text-gray-600 hover:text-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <button id="prevSlide" class="absolute left-4 text-blue-300 hover:text-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="nextSlide" class="absolute right-4 text-blue-300 hover:text-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</div>
