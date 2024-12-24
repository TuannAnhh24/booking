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
        <ul class="pagination">

            @if ($paginator->onFirstPage())
                <li class="page-item disabled not-allowed" aria-disabled="true">
                    <span class="page-link not-allowed" aria-hidden="true">{{ __('content.pagination.prev') }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                        rel="prev">{{ __('content.pagination.prev') }}</a>
                </li>
            @endif

            @if ($totalPages > $threshold)
                @if ($currentPage == 1)
                    <li class="page-item active bg-danger" aria-current="page"><span
                            class="page-link bg-danger">1</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                @endif

                @if ($currentPage > PAGINATE_LIMIT)
                    <li class="page-item disabled not-allowed"><span class="page-link">...</span></li>
                @endif

                @for ($i = max(2, $currentPage - 1); $i <= min($totalPages - 1, $currentPage + 1); $i++)
                    @if ($i == $currentPage)
                        <li class="page-item active bg-danger" aria-current="page"><span
                                class="page-link bg-danger">{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link"
                                href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                @if ($currentPage < $totalPages - 2)
                    <li class="page-item disabled not-allowed"><span class="page-link">...</span></li>
                @endif

                @if ($currentPage == $totalPages)
                    <li class="page-item active bg-danger" aria-current="page"><span
                            class="page-link bg-danger">{{ $totalPages }}</span></li>
                @else
                    <li class="page-item"><a class="page-link"
                            href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a></li>
                @endif
            @else
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled not-allowed" aria-disabled="true"><span
                                class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $currentPage)
                                <li class="page-item active bg-danger" aria-current="page"><span
                                        class="page-link bg-danger">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                        rel="next">{{ __('content.pagination.next') }}</a>
                </li>
            @else
                <li class="page-item disabled not-allowed" aria-disabled="true">
                    <span class="page-link not-allowed" aria-hidden="true">{{ __('content.pagination.next') }}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
<style>
    .not-allowed {
        cursor: not-allowed;
    }
</style>
