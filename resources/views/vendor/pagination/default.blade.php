@if ($paginator->hasPages())

    <div class="mt-2 -mr-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="pagination-item pagination-disabled">&laquo;</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a href="#" class="pagination-item pagination-disabled" rel="prev">{{ $element }}</a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="pagination-item pagination-active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" class="pagination-item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item" rel="next">&raquo;</a>
        @else
            <a href="#" class="pagination-item pagination-disabled">&raquo;</a>
        @endif
    </div>
@endif
