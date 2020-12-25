<section id="search-2" class="widget widget_search">
    <form role="search"  class="search-form" wire:submit.prevent="analyze">
        <input type="search"
        wire:model.debounce.500ms="search"
        autofocus wire:keydown.enter="render"
        placeholder="{{__('lang.type_to_search')}}"
        class="search-field">
        <button type="submit" class="search-submit"><i class="flaticon-search"></i></button>
    </form>
    @if (strlen($results) >0)
    <ul>
        @foreach ($results as $post)
          <li class="border-gray-700 mt-3">
              <a href="{{route('single.post',$post->slug)}}">
              <div class="right-content">
                  <h6>{{substr($post->title,0,32)}}</h6>
              </div>
              </a>
          </li>
        @endforeach
        </ul>
     @endif
     @if ($isEmpty)
     <div class="px-3 py-3"> {{__('lang.no_results_for')}} "{{ $search }}"</div>
     @endif
</section>
