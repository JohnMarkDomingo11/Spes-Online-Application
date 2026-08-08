@if ($paginator->hasPages())
    <nav>
        <div class="pagination">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span style="opacity:.4;">&laquo; Prev</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">&laquo; Prev</a>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}">Next &raquo;</a>
            @else
                <span style="opacity:.4;">Next &raquo;</span>
            @endif
        </div>
    </nav>
@endif
