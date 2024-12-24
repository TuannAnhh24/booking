<div id="aboutMeModal" class="fixed inset-0 overflow-hidden hidden z-10">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-y-0 right-0 flex max-w-full">
            <div class="w-screen max-w-[900px] transform translate-x-full transition-transform duration-300"
                id="modalPanel">
                <div class="flex h-full flex-col bg-white shadow-xl">
                    <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                        <div class="flex items-start justify-between">
                            <h2 class="text-xl text-gray-900 font-bold" id="slide-over-title">
                                {{ __('content.hotel_detail.review_title', ['destination' => $destination->name]) }}
                            </h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button" id="closeModalBtn"
                                    class="relative -m-2 p-2 text-gray-500 hover:text-blue-500">
                                    <span class="sr-only">{{ __('content.hotel_detail.close_panel') }}</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Nội dung chính -->
                        <div>
                            <div class="py-[24px] border-b border-[#e7e7e7]">
                                <div class="flex justify-between">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            <div
                                                class="w-[32px] h-[32px] bg-[#003c96] flex justify-center items-center text-white rounded-t rounded-br-[4px] mr-[10px]">
                                                {{ number_format($averageRating, 1) }}
                                            </div>
                                            <div class="mr-[18px]">
                                                <div class="text-base text-[#1A1A1A]">
                                                    {{ __('content.hotel_detail.very_good') }}
                                                </div>
                                                <div class="text-xs text-[#595959]">{{ $reviewCount }}
                                                    {{ __('content.hotel_detail.review_count') }}
                                                </div>
                                            </div>
                                            <a href="#" class="text-[#008234]">
                                                {{ __('content.hotel_detail.we_strive_for_100_percent_real_reviews') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        <button onclick="toggleModal(true)"
                                            class="py-[6px] px-[12px] border text-[#006ce4] border-blue-300 rounded hover:bg-blue-100">
                                            {{ __('content.hotel_detail.write_a_review') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="py-[24px] border-b border-[#e7e7e7]">
                                <div class="py-2">
                                    <h3 class="text-base font-bold mt-2 mb-2">
                                        {{ __('content.hotel_detail.categories') }}</h3>
                                </div>
                                <div class="grid grid-cols-3 gap-4 mt-2">
                                    <div>
                                        <div class="flex justify-between">
                                            <div>
                                                <div class="text-sm">{{ __('content.hotel_detail.staff_service') }}
                                                </div>
                                            </div>
                                            <div class="mt-2">{{ number_format($reviews->avg('staff_rating'), 1) }}
                                            </div>
                                        </div>
                                        @php
                                            $width = $reviews->avg('staff_rating') * 10;
                                        @endphp

                                        <div class="bg-gray-200 rounded-full h-[8px]">
                                            <span
                                                class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                                        </div>

                                    </div>
                                    <div>
                                        <div class="flex justify-between">
                                            <div>
                                                <div class="text-sm">{{ __('content.hotel_detail.comfort') }}</div>
                                            </div>
                                            <div class="mt-2">{{ number_format($reviews->avg('comfort_rating'), 1) }}
                                            </div>
                                        </div>
                                        @php
                                            $width = $reviews->avg('comfort_rating') * 10;
                                        @endphp

                                        <div class="bg-gray-200 rounded-full h-[8px]">
                                            <span
                                                class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="flex justify-between">
                                            <div>
                                                <div class="text-sm">{{ __('content.hotel_detail.cleanliness') }}</div>
                                            </div>
                                            <div class="mt-2">
                                                {{ number_format($reviews->avg('cleanliness_rating'), 1) }}</div>
                                        </div>
                                        @php
                                            $width = $reviews->avg('cleanliness_rating') * 10;
                                        @endphp

                                        <div class="bg-gray-200 rounded-full h-[8px]">
                                            <span
                                                class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="flex justify-between">
                                            <div>
                                                <div class="text-sm">{{ __('content.hotel_detail.amenities') }}</div>
                                            </div>
                                            <div class="mt-2">
                                                {{ number_format($reviews->avg('amenities_rating'), 1) }}</div>
                                        </div>
                                        @php
                                            $width = $reviews->avg('amenities_rating') * 10;
                                        @endphp

                                        <div class="bg-gray-200 rounded-full h-[8px]">
                                            <span
                                                class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="flex justify-between">
                                            <div class="flex gap-1 text-sm">
                                                {{ __('content.hotel_detail.value_for_money') }}</div>
                                            <div class="mt-2">
                                                {{ number_format($reviews->avg('value_for_money_rating'), 1) }}</div>
                                        </div>
                                        @php
                                            $width = $reviews->avg('value_for_money_rating') * 10;
                                        @endphp

                                        <div class="bg-gray-200 rounded-full h-[8px]">
                                            <span
                                                class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="flex justify-between">
                                            <div>
                                                <div class="text-sm">{{ __('content.hotel_detail.location') }}</div>
                                            </div>
                                            <div class="mt-2">
                                                {{ number_format($reviews->avg('location_rating'), 1) }}</div>
                                        </div>
                                        @php
                                            $width = $reviews->avg('location_rating') * 10;
                                        @endphp

                                        <div class="bg-gray-200 rounded-full h-[8px]">
                                            <span
                                                class="bg-green-500 block rounded-full h-[8px] w-[{{ $width }}%]"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="py-[24px]">
                                <div class="py-2 flex justify-between items-center">
                                    <h4 class="text-base font-bold mt-2 mb-2">
                                        {{ __('content.hotel_detail.guest_reviews') }}</h4>
                                    <div class="flex items-center gap-[8px]">
                                        <span>{{ __('content.hotel_detail.sort_reviews_by') }}:</span>
                                        <div class="block w-full">
                                            <select id="sortReviews"
                                                class="h-8 border border-gray-300 text-gray-600 text-sm rounded-md block w-full py-1.5 px-4 focus:outline-none">
                                                <option selected>{{ __('content.hotel_detail.most_relevant') }}
                                                </option>
                                                <option value="highest_rating">
                                                    {{ __('content.hotel_detail.highest_rating') }}</option>
                                                <option value="lowest_rating">
                                                    {{ __('content.hotel_detail.lowest_rating') }}</option>
                                                <option value="most_recent">
                                                    {{ __('content.hotel_detail.most_recent') }}</option>
                                                <option value="least_recent">
                                                    {{ __('content.hotel_detail.least_recent') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="reviewsContainer">
                                    @include('client.hotel_details.partials.reviews_list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
