<div>
  <div class="bg-[#003b95]">
    <div class="w-[1024px] mx-auto max-w-full">
      <div class="h-full relative">
        <!-- banner -->
        <div class="pt-14 pb-14">
            <h1 class="text-5xl font-black text-white leading-none">
              @if(auth()->check())
                  {{ Auth::user()->first_name }}{{ __('content.banner_client.next-home') }}
              @else
                {{ __('content.banner_client.search_next') }}
              @endif
            </h1>
            <span class="text-2xl text-white block mt-6 leading-none">{{ __('content.banner_client.search_home') }}</span>
        </div>
      
        <div class="max-w-[1024px] w-full h-16 bg-[#feb704] absolute top-[calc(100%)] left-[50%] transform -translate-y-1/2 -translate-x-1/2 rounded-lg z-40">
            @include('client.home.search')
        </div>
    </div>
  </div>
</div>
<style>
  .focus-child.open {
    display: flex;
  }
</style>

<script>

        window.addEventListener('click', function() {
            hide();
        });

        btnChildFocus.forEach((child) => {
            child.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        });
    </script>
