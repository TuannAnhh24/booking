<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
<!-- Font Awesome -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
/>

<!-- Ionicons -->
<script
  type="module"
  src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
></script>

<!-- Bootstrap Icons -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
  integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd"
  crossorigin="anonymous"
/>

<div>
  {{-- <!-- header  -->
  <header style="background-color: #003b95">
    <div
      class="max-w-screen-lg mx-auto px-4 flex justify-between items-center p-4"
    >
      <div>
      
        <a href="{{ route('home') }}"class="text-white font-medium text-3xl pl-2" >{{ __('content.header.logo') }}</a>
      </div>
    
    </div>
  </header> --}}
  @include('client.yourproperty.header')
 
  <!-- banenr  -->
  <div class="bg-[#003b95]">
    <div class="banner pt-16">
      @yield('content')
    </div>
  </div>
  <!-- Menu  -->
  <div class="menu bg-gray-100">
    <div class="max-w-screen-lg mx-auto px-4">
      <div class="flex">
        <button
          class="block' hover:bg-gray-300 text-sm px-3 py-5 text-blue-500 border-b-2 border-blue-500">
        {{__('content.yourproperty.an_tam_dang')}}
        </button>
       
      </div>
    </div>
  </div>

  <!-- content 1  -->
  <div class="max-w-screen-lg mx-auto pt-16">
    <div>
      <h1 class="text-5xl font-bold">  {{__('content.yourproperty.an_tam_dang')}}</h1>
    </div>
    <div class="grid grid-cols-12 gap-8 pt-8">
      <!-- nội dung 1  -->
      <div class="col-span-6">
        <div class="flex items-start">
          <i class="far fa-check-circle text-3xl"></i>
          <div class="flex flex-col pl-4">
            <span class="font-bold text-xl">{{__('content.yourproperty.title.title_1')}}</span>
            <span class="block"
              ><a href="" >{{__('content.yourproperty.content.content_1')}}</a></span
            >
          </div>
        </div>
      </div>
      <!-- nội dung 2  -->
      <div class="col-span-6">
        <div class="flex items-start">
          <i class="far fa-check-circle text-3xl"></i>
          <div class="flex flex-col pl-4">
            <span class="font-bold text-xl"
              >{{__('content.yourproperty.title.title_2')}}</span
            >
            <span>{{__('content.yourproperty.content.content_2')}}</span>
          </div>
        </div>
      </div>
      <!-- nội dung 3  -->
      <div class="col-span-6">
        <div class="flex items-start">
          <i class="far fa-check-circle text-3xl"></i>
          <div class="flex flex-col pl-4">
            <span class="font-bold text-xl">{{__('content.yourproperty.title.title_3')}}</span>
            <span class="block"
              >{{__('content.yourproperty.content.content_3')}}
            </span>
          </div>
        </div>
      </div>
      <!-- nội dung 4  -->
      <div class="col-span-6">
        <div class="flex items-start">
          <i class="far fa-check-circle text-3xl"></i>
          <div class="flex flex-col pl-4">
            <span class="font-bold text-xl">{{__('content.yourproperty.title.title_4')}}</span>
            <span class="block"
              >{{__('content.yourproperty.content.content_4')}}
            </span>
          </div>
        </div>
      </div>
      <!-- nội dung 5  -->
      <div class="col-span-6">
        <div class="flex items-start">
          <i class="far fa-check-circle text-3xl"></i>
          <div class="flex flex-col pl-4">
            <span class="font-bold text-xl"
              >{{__('content.yourproperty.title.title_5')}}</span
            >
            <span class="block"
              >{{__('content.yourproperty.title.title_5')}}</span
            >
          </div>
        </div>
      </div>
      <!-- nội dung 6  -->
      <div class="col-span-6">
        <div class="flex items-start">
          <i class="far fa-check-circle text-3xl"></i>
          <div class="flex flex-col pl-4">
            <span class="font-bold text-xl">{{__('content.yourproperty.title.title_6')}}</span>
            <span class="block"
              >{{__('content.yourproperty.content.content_6')}}
            </span>
          </div>
        </div>
      </div>
      <!-- nội dung 7  -->
      <div class="col-span-6 pb-20">
        <div class="flex items-start">
          <i class="far fa-check-circle text-3xl"></i>
          <div class="flex flex-col pl-4">
            <span class="font-bold text-xl">{{__('content.yourproperty.title.title_7')}}</span>
            <span class="block"
              ><a href="" 
                >{{__('content.yourproperty.content.content_7')}}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('client.layouts.footer')
</div>