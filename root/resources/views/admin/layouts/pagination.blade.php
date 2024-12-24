@php
    $showPagination = $paginator->total() > PAGINATE_MAX_RECORD;
    $totalPages = $paginator->lastPage();
    $currentPage = $paginator->currentPage();
    $threshold = 5;
@endphp

@if ($paginator->total())
    <div>
        <p>{{ __('content.pagination.Showing') }} {{ $paginator->firstItem() }} {{ __('content.pagination.to') }}
            {{ $paginator->lastItem() }} {{ __('content.pagination.of') }} {{ $paginator->total() }}</p>
    </div>
@endif

@if ($showPagination)
    <nav aria-label="Page navigation example" class="p-2">
        <ul class="flex list-none space-x-2">
            @if ($paginator->onFirstPage())
                <li class="disabled cursor-not-allowed">
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded">{{ __('content.pagination.prev') }}</span>
                </li>
            @else
                <li>
                    <a class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ __('content.pagination.prev') }}</a>
                </li>
            @endif

            @if ($totalPages > $threshold)
                @if ($currentPage == 1)
                    <li class="active">
                        <span class="px-4 py-2 bg-blue-500 text-white rounded">{{ 1 }}</span>
                    </li>
                @else
                    <li>
                        <a class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300" href="{{ $paginator->url(1) }}">{{ 1 }}</a>
                    </li>
                @endif

                @if ($currentPage > PAGINATE_LIMIT)
                    <li class="disabled cursor-not-allowed"><span class="px-4 py-2">...</span></li>
                @endif

                @for ($i = max(2, $currentPage - 1); $i <= min($totalPages - 1, $currentPage + 1); $i++)
                    @if ($i == $currentPage)
                        <li class="active">
                            <span class="px-4 py-2 bg-blue-500 text-white rounded">{{ $i }}</span>
                        </li>
                    @else
                        <li>
                            <a class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
                @endfor

                @if ($currentPage < $totalPages - 2)
                    <li class="disabled cursor-not-allowed"><span class="px-4 py-2">...</span></li>
                @endif

                @if ($currentPage == $totalPages)
                    <li class="active">
                        <span class="px-4 py-2 bg-blue-500 text-white rounded">{{ $totalPages }}</span>
                    </li>
                @else
                    <li>
                        <a class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300" href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a>
                    </li>
                @endif
            @else
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled cursor-not-allowed"><span class="px-4 py-2">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $currentPage)
                                <li class="active">
                                    <span class="px-4 py-2 bg-blue-500 text-white rounded">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif

            @if ($paginator->hasMorePages())
                <li>
                    <a class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('content.pagination.next') }}</a>
                </li>
            @else
                <li class="disabled cursor-not-allowed">
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded">{{ __('content.pagination.next') }}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
