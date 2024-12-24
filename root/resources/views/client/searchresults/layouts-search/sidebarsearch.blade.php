<!-- navbar sreach -->
<div class="h-full rounded-md lg:col-span-2">
    <div
        class="flex flex-col border border-solid border-[#eaecf0] rounded-lg shadow-[0_1px_3px_0px_rgba(16,24,40,.1)] bg-white">
        <!-- Title navbar-sreach -->
        <div class="flex justify-between py-5 px-3 border-b">
            <h1 class="text-lg font-semibold">{{ __('content.search.filter') }}</h1>
        </div>
        <div class="">
            <div class="">
                <input id="labels-range-input" type="hidden" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                    value="{{ $minPrice }}" class="" />
            </div>
        </div>
        <!-- Bộ lọc loại chỗ ở -->
        <div class="py-5 px-3 border-b">
            <h1 class="text-base text-[#000] font-semibold">{{ __('content.search.filter_category') }}</h1>
            <div class="flex flex-col gap-2 pt-3 pl-2">
                <!-- Lặp qua categories của từng hotel -->
                @foreach ($categories as $category)
                    <div class="inline-flex items-center justify-between">
                        <div class="flex items-center">
                            <label class="relative flex items-center rounded-full cursor-pointer"
                                for="category-{{ $category->id }}">
                                <input type="checkbox"
                                    class="filter-input before:content[''] peer relative h-[20px] w-[20px] cursor-pointer appearance-none border border-[#868686] rounded-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-8 before:w-8 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-blue-500 hover:before:opacity-10"
                                    id="category-{{ $category->id }}" />
                                <span
                                    class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor" stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </label>
                            <span class="pl-2 text-[13px] leading-tight">{{ $category->name }}</span>
                        </div>
                        <span class="text-[13px]">{{ $category->destinations_count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="py-5 px-3 border-b">
            <h1 class="text-base text-[#000] font-semibold">
                {{ __('content.search.filter_rate') }}
            </h1>
            <div class="flex flex-col gap-2 pt-3 pl-2">
                @foreach ($ratings->sortKeysDesc() as $rating => $count)
                    <div class="inline-flex items-center justify-between">
                        <div class="flex items-center">
                            <label class="relative flex items-center rounded-full cursor-pointer"
                                for="rating-{{ $rating }}">
                                <input type="checkbox"
                                    class="filter-input before:content[''] peer relative h-[20px] w-[20px] cursor-pointer appearance-none border border-[#868686] rounded-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-8 before:w-8 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-blue-500 hover:before:opacity-10"
                                    id="rating-{{ $rating }}" />
                                <span
                                    class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor" stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </label>
                            <span class="pl-2 text-[13px] leading-tight">{{ __('content.search.rating') }}
                                >{{ $rating }}đ</span>
                        </div>
                        <span class="text-[13px]">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="py-5 px-3 border-b">
            <h1 class="text-base text-[#000] font-semibold">
                {{ __('content.search.filter_convenient') }}
            </h1>
            <div class="flex flex-col gap-2 pt-3 pl-2">
                <!-- Lặp qua categories của từng hotel -->
                @foreach ($convenients as $convenient)
                    <div class="inline-flex items-center justify-between">
                        <div class="flex items-center">
                            <label class="relative flex items-center rounded-full cursor-pointer"
                                for="convenient-{{ $convenient->id }}">
                                <input type="checkbox"
                                    class="filter-input before:content[''] peer relative h-[20px] w-[20px] cursor-pointer appearance-none border border-[#868686] rounded-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-8 before:w-8 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-blue-500 hover:before:opacity-10"
                                    id="convenient-{{ $convenient->id }}" />
                                <span
                                    class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                        fill="currentColor" stroke="currentColor" stroke-width="1">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </label>
                            <span class="pl-2 text-[13px] leading-tight">{{ $convenient->name }}</span>
                        </div>
                        <span class="text-[13px]">{{ $convenient->destinations_count }}</span>
                    </div>
                @endforeach

            </div>
        </div>
        {{-- <div class="py-5 px-3 border-b">
              <h1 class="text-base text-[#000] font-semibold">
                  {{ __('content.search.filter_variant') }}
              </h1>
              <div class="flex flex-col gap-2 pt-3 pl-2">
                  <!-- Lặp qua categories của từng hotel -->
                  @foreach ($variants as $variant)
                      <div class="inline-flex items-center justify-between">
                          <div class="flex items-center">
                              <label class="relative flex items-center rounded-full cursor-pointer"
                                  for="variant-{{ $variant->id }}">
                                  <input type="checkbox"
                                      class="filter-input before:content[''] peer relative h-[20px] w-[20px] cursor-pointer appearance-none border border-[#868686] rounded-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-8 before:w-8 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-blue-500 hover:before:opacity-10"
                                      id="variant-{{ $variant->id }}" />
                                  <span
                                      class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                          fill="currentColor" stroke="currentColor" stroke-width="1">
                                          <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"></path>
                                      </svg>
                                  </span>
                              </label>
                              <span class="pl-2 text-[13px] leading-tight">{{ $variant->name }}</span>
                          </div>
                          <span class="text-[13px]">{{ $variant->rooms_count }}</span>
                      </div>
                  @endforeach
              </div>
          </div> --}}
    </div>

</div>
