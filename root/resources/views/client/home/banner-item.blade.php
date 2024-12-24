
<div class="py-5">
    <div class="w-[1024px] mx-auto max-w-full characteristic">
        <div class="h-full relative mx-0 lg:mx-5">
            <!-- banner-sale -->
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8 my-3">
                <div class="flex flex-row border border-stone-200 p-4 m-2 rounded-lg">
                    <img class="size-14" src="{{ asset('image/booking.png')}}" alt="{{ asset('image/booking.png')}}" />
                    <div class="ml-3">
                        <h2 class="text-base font-bold">
                            {{ __('content.destination_home.booking') }}
                        </h2>
                        <p class="text-sm mt-2">{{ __('content.destination_home.free') }}</p>
                    </div>
                </div>
                <div class="flex flex-row border border-stone-200 p-4 m-2 rounded-lg">
                    <img class="size-14" src="{{ asset('image/worlwide.png')}}" alt="{{ asset('image/worlwide.png')}}" />
                    <div class="ml-3">
                        <h2 class="text-base font-bold">{{ __('content.destination_home.more') }} {{ $destinations->count() }} {{ __('content.destination_home.accommodation') }} </h2>
                        <p class="text-sm mt-2">
                            {{ __('content.destination_home.destination') }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-row border border-stone-200 p-4 m-2 rounded-lg">
                    <img class="size-14" src="{{ asset('image/customer-service.png')}}" alt="{{ asset('image/customer-service.png')}}" />
                    <div class="ml-3">
                        <h2 class="text-base font-bold">
                            {{ __('content.destination_home.service') }}
                        </h2>
                        <p class="text-sm mt-2">{{ __('content.destination_home.help') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>