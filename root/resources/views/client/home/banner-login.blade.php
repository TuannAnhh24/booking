
@if(auth()->check())

@else
<div class="py-5">
    <div class="w-[1024px] mx-auto max-w-full characteristic mt-[35px]">
        <div class="h-full relative">
            <!-- banner-login -->
            <div class="flex flex-row border rounded-md p-4 shadow-md">
                <img class="size-40 rounded-md" src="{{ asset('image/password.png')}}" alt="{{ asset('image/password.png')}}" />
                <div class="ml-5">
                    <h1 class="text-xl font-bold">{{ __('content.banner_login.sale') }}</h1>
                    <p class="mt-2">
                        {{ __('content.banner_login.login_sale') }}
                    </p>
                    <div class="dangnhap mt-5">
                        <a href="{{ route('login')}}"
                            class="border border-blue-600 p-2 text-center hover:bg-blue-600 hover:bg-opacity-10 text-blue-600 rounded-md">{{ __('content.header.login') }}</a>
                        <a href="{{ route('register') }}"
                            class="hover:bg-blue-600 hover:bg-opacity-10 p-2 text-center text-blue-600 rounded-md">{{ __('content.header.register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif