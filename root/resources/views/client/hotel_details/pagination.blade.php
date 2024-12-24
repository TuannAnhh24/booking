@if ($paginator->hasPages())
    <div id="pagination">
        <div class="border py-[4px] px-[12px] rounded-md">
            <div class="flex flex-col lg:flex-row justify-between">
                <nav aria-label="Pagination" class="flex justify-center items-center text-[#006ce4] mt-8 lg:mt-0">
                    {{-- Nút trang trước --}}
                    @if ($paginator->onFirstPage())
                        <span class="p-2 mr-4 rounded text-gray-300 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                            class="pagination-link p-2 mr-4 rounded hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    @endif

                    {{-- Các trang --}}
                    @foreach ($elements as $element)
                        {{-- Nếu là một chuỗi --}}
                        @if (is_string($element))
                            <span class="px-4 py-2 rounded">{{ $element }}</span>
                        @endif

                        {{-- Nếu là một mảng --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span
                                        class="px-4 py-2 rounded bg-gray-200 text-[#006ce4] font-medium">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="pagination-link px-4 py-2 rounded hover:bg-gray-100">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Nút trang tiếp theo --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                            class="pagination-link p-2 ml-4 rounded hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span class="p-2 ml-4 rounded text-gray-300 cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endif
