
<div class="py-5">
    <div class="w-[1024px] mx-auto max-w-full characteristic mt-[35px]">
        <div class="h-full relative">
            <!-- banner-sale -->
            <div class="container mx-auto">
                <h1 class="text-2xl font-bold">{{ __('content.banner_sale.endow') }} </h1>
                <p class="py-4">{{ __('content.banner_sale.promotion') }}</p>
                <div class="sliderAx h-auto">
                    <div id="slider-1" class="container mx-auto">
                        <div class="bg-cover bg-center h-auto text-white py-11 rounded-md object-fill"
                            style="background-image: url('{{ !empty($banner->img_banner) ? asset('storage/' . $banner->img_banner) : 'https://placehold.co/600x400' }}');">
                            <div class="md:w-1/2 pl-5">
                                <p class="font-bold text-lg uppercase pb-2">
                                    {{ __('content.banner_sale.booking_hand') }}
                                </p>
                                <p class="text-sm pb-5">
                                    {{ __('content.banner_sale.voucher-sale') }}
                                </p>
                                {{-- <a href="#"
                                    class="w-full p-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">
                                    {{ __('content.banner_sale.sale_season') }}
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>