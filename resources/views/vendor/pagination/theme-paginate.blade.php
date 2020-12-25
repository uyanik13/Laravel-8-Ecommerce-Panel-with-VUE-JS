@if ($paginator->hasPages())
<div class="page-navigation-wrap mt-4">
    <div class="page-navigation mx-auto">
   
    @if ($paginator->onFirstPage())
        <a class="page-go page-prev"  aria-disabled="true" aria-label="@lang('pagination.previous')"><i class="la la-arrow-left"></i> </a>
        @else
        <a class="page-go page-prev"  href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="la la-arrow-left"></i> </a>
    @endif


    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
        <a class="icon item disabled" aria-disabled="true">{{ $element }}</a>
    @endif
    
    {{-- Array Of Links --}}
    <ul class="page-navigation-nav">
    @if (is_array($element))
    @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
              <li class="active"><a href="{{ $url }}" aria-current="page" class="page-go-link">{{ $page }}</a></li>
        @else
        <li ><a href="{{ $url }}" aria-current="page" class="page-go-link">{{ $page }}</a></li>
        @endif
    @endforeach
@endif
@endforeach
</ul>
        



        @if ($paginator->hasMorePages())
        <a class="page-go page-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> <i class="la la-arrow-right"></i> </a>
    @else
         <a lass="page-go page-next"  aria-disabled="true" aria-label="@lang('pagination.next')"> <i class="la la-arrow-right"></i></a>
    @endif
       

    </div>
</div><!-- end page-navigation-wrap -->
@endif