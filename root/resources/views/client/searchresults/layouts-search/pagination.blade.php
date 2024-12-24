@php
    $showPagination = $paginator->total() > PAGINATE_MAX_RECORD;
    $totalPages = $paginator->lastPage();
    $currentPage = $paginator->currentPage();
    $threshold = 5;
@endphp
@if ($showPagination)
<div class="flex justify-center items-center gap-4 mt-6">
    <!-- Previous Button -->
    <button 
        @disabled($paginator->onFirstPage())
        class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button" 
        @if (!$paginator->onFirstPage()) 
            onclick="window.location='{{ $paginator->previousPageUrl() }}'" 
        @endif>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
        </svg>
        {{__('content.search.pre')}}
    </button>

    <!-- Page Numbers -->
    <div class="flex items-center gap-2">
        @if ($totalPages > $threshold)
            <!-- First Page -->
            <button
                class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg {{ $currentPage == 1 ? 'bg-[#003b96] text-white' : 'bg-gray-200 text-gray-900' }} text-center align-middle font-sans text-xs font-medium uppercase shadow-md transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                @if ($currentPage != 1) 
                    onclick="window.location='{{ $paginator->url(1) }}'"
                @endif>
                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">1</span>
            </button>

            @if ($currentPage > 2)
                <span class="flex items-center gap-2">...</span>
            @endif

            <!-- Middle Pages -->
            @for ($i = max(2, $currentPage - 1); $i <= min($totalPages - 1, $currentPage + 1); $i++)
                <button
                    class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg {{ $i == $currentPage ? 'bg-[#003b96] text-white' : 'bg-gray-200 text-gray-900' }} text-center align-middle font-sans text-xs font-medium uppercase shadow-md transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    @if ($i != $currentPage) 
                        onclick="window.location='{{ $paginator->url($i) }}'"
                    @endif>
                    <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">{{ $i }}</span>
                </button>
            @endfor

            @if ($currentPage < $totalPages - 1)
                <span class="flex items-center gap-2">...</span>
            @endif

            <!-- Last Page -->
            <button
                class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg {{ $currentPage == $totalPages ? 'bg-[#003b96] text-white' : 'bg-gray-200 text-gray-900' }} text-center align-middle font-sans text-xs font-medium uppercase shadow-md transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                @if ($currentPage != $totalPages) 
                    onclick="window.location='{{ $paginator->url($totalPages) }}'"
                @endif>
                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">{{ $totalPages }}</span>
            </button>
        @else
            <!-- Loop through all pages when total pages are small -->
            @foreach (range(1, $totalPages) as $i)
                <button
                    class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg {{ $i == $currentPage ? 'bg-[#003b96] text-white' : 'bg-gray-200 text-gray-900' }} text-center align-middle font-sans text-xs font-medium uppercase shadow-md transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    @if ($i != $currentPage) 
                        onclick="window.location='{{ $paginator->url($i) }}'"
                    @endif>
                    <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">{{ $i }}</span>
                </button>
            @endforeach
        @endif
    </div>

    <!-- Next Button -->
    <button 
        @disabled($paginator->hasMorePages() == false)
        class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
        type="button" 
        @if ($paginator->hasMorePages()) 
            onclick="window.location='{{ $paginator->nextPageUrl() }}'" 
        @endif>
        {{__('content.search.next')}}
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
        </svg>
    </button>
</div>
@endif