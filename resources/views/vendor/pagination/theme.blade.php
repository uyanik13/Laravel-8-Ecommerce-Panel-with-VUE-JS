@if ($paginator->hasPages())
        <ul class="page-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"><i class="flaticon-arrow-pointing-to-left"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl()}}" rel="prev" aria-label="@lang('pagination.previous')"><i class="flaticon-arrow-pointing-to-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                        <li><span aria-current="page" class="page-numbers current">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="page-numbers">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="flaticon-arrow-pointing-to-right"></i></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><i class="flaticon-arrow-pointing-to-left"></i></span>
                </li>
            @endif
        </ul>
@endif



