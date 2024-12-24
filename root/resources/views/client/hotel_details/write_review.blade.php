<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[1000]">
    <!-- Modal Content with max width and responsive padding -->
    <div class="bg-white w-full rounded-lg p-8 relative z-[1001] overflow-y-auto max-h-[90vh] shadow-lg max-w-[1000px]">
        <button onclick="toggleModal(false)" class="absolute top-2 right-2 text-gray-500 hover:text-red-600">
                <i class="ri-close-circle-line text-red-500 text-2xl"></i>
        </button>
        <h2 class="text-2xl font-semibold text-[#006ce4] mb-6 text-center">
            {{ __('content.hotel_detail.write_your_review') }}
        </h2>

        <!-- Review Form -->
        <form id="reviewForm" action="{{ route('writeReview', ['id' => $destination->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="rating" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.overall_rating') }}
                    </label>
                    <select name="rating" id="rating"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        required>
                        <option value="10">{{ __('content.hotel_detail.very_good') }}</option>
                        <option value="8">{{ __('content.hotel_detail.good') }}</option>
                        <option value="6">{{ __('content.hotel_detail.average') }}</option>
                        <option value="4">{{ __('content.hotel_detail.poor') }}</option>
                        <option value="2">{{ __('content.hotel_detail.very_poor') }}</option>
                    </select>
                </div>

                <div>
                    <label for="staff_rating" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.staff_service') }}
                    </label>
                    <select name="staff_rating" id="staff_rating"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        required>
                        <option value="10">{{ __('content.hotel_detail.very_good') }}</option>
                        <option value="8">{{ __('content.hotel_detail.good') }}</option>
                        <option value="6">{{ __('content.hotel_detail.average') }}</option>
                        <option value="4">{{ __('content.hotel_detail.poor') }}</option>
                        <option value="2">{{ __('content.hotel_detail.very_poor') }}</option>
                    </select>
                </div>

                <div>
                    <label for="comfort_rating" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.comfort') }}
                    </label>
                    <select name="comfort_rating" id="comfort_rating"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        required>
                        <option value="10">{{ __('content.hotel_detail.very_good') }}</option>
                        <option value="8">{{ __('content.hotel_detail.good') }}</option>
                        <option value="6">{{ __('content.hotel_detail.average') }}</option>
                        <option value="4">{{ __('content.hotel_detail.poor') }}</option>
                        <option value="2">{{ __('content.hotel_detail.very_poor') }}</option>
                    </select>
                </div>

                <div>
                    <label for="amenities_rating" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.amenities') }}
                    </label>
                    <select name="amenities_rating" id="amenities_rating"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        required>
                        <option value="10">{{ __('content.hotel_detail.very_good') }}</option>
                        <option value="8">{{ __('content.hotel_detail.good') }}</option>
                        <option value="6">{{ __('content.hotel_detail.average') }}</option>
                        <option value="4">{{ __('content.hotel_detail.poor') }}</option>
                        <option value="2">{{ __('content.hotel_detail.very_poor') }}</option>
                    </select>
                </div>

                <div>
                    <label for="value_for_money_rating" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.value_for_money') }}
                    </label>
                    <select name="value_for_money_rating" id="value_for_money_rating"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        required>
                        <option value="10">{{ __('content.hotel_detail.very_good') }}</option>
                        <option value="8">{{ __('content.hotel_detail.good') }}</option>
                        <option value="6">{{ __('content.hotel_detail.average') }}</option>
                        <option value="4">{{ __('content.hotel_detail.poor') }}</option>
                        <option value="2">{{ __('content.hotel_detail.very_poor') }}</option>
                    </select>
                </div>

                <div>
                    <label for="location_rating" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.location') }}
                    </label>
                    <select name="location_rating" id="location_rating"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        required>
                        <option value="10">{{ __('content.hotel_detail.very_good') }}</option>
                        <option value="8">{{ __('content.hotel_detail.good') }}</option>
                        <option value="6">{{ __('content.hotel_detail.average') }}</option>
                        <option value="4">{{ __('content.hotel_detail.poor') }}</option>
                        <option value="2">{{ __('content.hotel_detail.very_poor') }}</option>
                    </select>
                </div>

                <div>
                    <label for="cleanliness_rating" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.cleanliness') }}
                    </label>
                    <select name="cleanliness_rating" id="cleanliness_rating"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        required>
                        <option value="10">{{ __('content.hotel_detail.very_good') }}</option>
                        <option value="8">{{ __('content.hotel_detail.good') }}</option>
                        <option value="6">{{ __('content.hotel_detail.average') }}</option>
                        <option value="4">{{ __('content.hotel_detail.poor') }}</option>
                        <option value="2">{{ __('content.hotel_detail.very_poor') }}</option>
                    </select>
                </div>

                <!-- Full Width Textarea for Comment -->
                <div class="col-span-2">
                    <label for="comment" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.review_content') }}
                    </label>
                    <textarea name="comment" id="comment" rows="4"
                        class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[#006ce4]"
                        placeholder="{{ __('content.hotel_detail.enter_review_content') }}"></textarea>
                </div>

                <!-- Image Upload Full Width -->
                <div class="col-span-2">
                    <label for="imageUpload" class="block font-medium text-gray-700">
                        {{ __('content.hotel_detail.upload_images') }}
                    </label>
                    <input type="file" name="review_images[]" id="imageUpload" accept="image/*" multiple
                        onchange="previewImages(event)" class="w-full border rounded-lg p-2 focus:outline-none">
                    <!-- Preview Images -->
                    <div id="imagePreviewContainer" class="mt-4 hidden">
                        <p class="text-gray-500 font-medium">{{ __('content.hotel_detail.preview_images') }}</p>
                        <div id="previewGrid" class="grid grid-cols-3 gap-3 mt-2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <button type="submit"
                    class="w-full py-3 px-4 bg-[#006ce4] text-white rounded-lg font-semibold hover:bg-[#005bb5] transition duration-200">
                    {{ __('content.hotel_detail.submit_review') }}
                </button>
            </div>
        </form>
    </div>
</div>
