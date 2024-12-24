<div class="pb-5 mt-[35px]">
    <!-- Phổ biến với du khách từ Việt Nam -->
    <div class="max-w-[1024px] mx-auto characteristic">
        <div class="h-full relative mx-0 lg:mx-5">
            <!-- destination-2 -->
            <div class="mt-5 mb-20">
                <h1 class="text-2xl font-bold py-5">
                    {{ __('content.favorites_location.popular') }}
                </h1>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @if ($locations->isEmpty())
                        <div class="mt-2">
                            <p class="font-bold text-sm">{{ __('content.favorites_location.no_favorites') }}</p>
                        </div>
                    @else
                        @foreach ($locations as $location)
                            <div class="p-3 shadow-md bg-[#eff6fe] rounded-md">
                                <a href="{{ route('client.search', ['location' => $location->name, 'check_in' => now()->format('Y-m-d'), 'check_out' => now()->addDay()->format('Y-m-d'), 'people_old' => 2, 'rooms' => 1]) }}"
                                    class="font-bold text-sm hover:underline-offset-4">{{ $location->name }}</a>
                                <p class="text-xs">{{ $location->destinations_count }}
                                    {{ __('content.favorites_location.accommodation') }} </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
