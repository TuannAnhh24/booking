@if ($reviews->isEmpty())
    <p class="text-center text-gray-500 mt-4">
        {{ __('content.hotel_detail.no_reviews_available') }}
    </p>
@else
    @foreach ($reviews as $review)
        <div class="flex mt-[48px] gap-[45px] border-b border-[#e7e7e7] pb-[24px]">
            <div class="flex flex-col min-w-[190px]">
                <div class="flex items-center gap-[10px] mb-[20px]">
                    <img src="{{ asset('storage/' . $review->user->avatar) ?? 'https://cdn-icons-png.flaticon.com/512/1144/1144760.png' }}"
                        class="w-[32px] h-[32px] rounded-full" alt="">
                    <span>{{ $review->user->first_name }} {{ $review->user->last_name }}</span>
                </div>
                <div class="flex items-center gap-[10px] mb-[12px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-[16px] h-[16px]">
                        <path
                            d="M32 32c17.7 0 32 14.3 32 32l0 256 224 0 0-160c0-17.7 14.3-32 32-32l224 0c53 0 96 43 96 96l0 224c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32-224 0-32 0L64 416l0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32L0 64C0 46.3 14.3 32 32 32zm144 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z" />
                    </svg>
                    <p class="text-xs">{{ $review->destination->name }}</p>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <div class="flex justify-between w-full">
                    <div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                class="w-[16px] h-[16px] text-[#946800] mr-[9px]">
                                <path
                                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>
                            <div class="text-[#946800]">{{ __('content.hotel_detail.top_review') }}
                                <span class="text-xs text-[#595959]">{{ __('content.hotel_detail.review_date') }}:
                                    {{ $review->created_at ? $review->created_at->format('d/m/Y') : __('content.hotel_detail.not_available') }}</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-[38px] h-[38px] bg-[#003c96] flex justify-center items-center text-white rounded-t rounded-br-[4px] mr-[10px]">
                        {{ number_format($review->rating_avg, 1) }}
                    </div>
                </div>
                <div class="flex gap-2 mt-[24px] items-start">
                    <div>
                        @if (number_format($review->rating_avg, 1) > 5)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-[16px] h-[16px]">
                                <path
                                    d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm177.6 62.1C192.8 334.5 218.8 352 256 352s63.2-17.5 78.4-33.9c9-9.7 24.2-10.4 33.9-1.4s10.4 24.2 1.4 33.9c-22 23.8-60 49.4-113.6 49.4s-91.7-25.5-113.6-49.4c-9-9.7-8.4-24.9 1.4-33.9s24.9-8.4 33.9 1.4zM144.4 208a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192-32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-[16px] h-[16px]">
                                <path
                                    d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm128 160c0-30.9 25.1-56 56-56h112c30.9 0 56 25.1 56 56h-224zm28-128a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm192 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                            </svg>
                        @endif
                    </div>
                    <p>{{ $review->comment }}</p>
                </div>
                @if ($review->images->count() > 0)
                    <div class="flex min-h-[80px] max-w-[80px] gap-3 mt-[24px]">
                        @foreach ($review->images as $image)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $image->image) }}"
                                alt="">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    <div class="pagination">
        {{ $reviews->appends(request()->except('page'))->links('client.hotel_details.pagination') }}
    </div>
@endif
