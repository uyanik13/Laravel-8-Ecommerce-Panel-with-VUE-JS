<aside class="widget-area primary-sidebar col-lg-4 col-md-3 col-sm-12 col-xs-12">



    <livewire:post-search>
    <section class="widget widget_categories">
        <h5 class="widget-title mb-5 text-3xl">{{__('lang.categories')}}</h5>
        <ul>
            @foreach ($blogCategories as $bCat)
            <li class="ml-10"><a href="{{route('single.category',$bCat->slug)}}">{{$bCat->title}}<span class="posts-count">({{count(getCategoryPosts($bCat->id))}})</span></a></li>
             @endforeach

        </ul>
    </section>

    <section class="widget widget_recent_news">
        <h5 class="widget-title mb-5 text-3xl">{{__('lang.recent_posts')}}</h5>
        <ul class="recent-news clearfix">

            @foreach ($posts as $index => $post)
            @if ($index <= 9)
            <li class="clearfix ml-10">
                <div class="thumb">
                    <a href="{{route('single.post',[$post->category->slug,$post->slug])}}">
                        <img src="{{$post->thumbnail}}" class="h-24 w-24" alt="{{$post->title}}">
                    </a>
                </div>
                <div class="">
                    <h6><a href="{{route('single.post',[$post->category->slug,$post->slug])}}">{{substr($post->title,0,71)}}</a></h6>
                    <span class="post-on mt-0"><span class="entry-date">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span></span>
                </div>
            </li>
            @endif
            @endforeach

        {{-- @foreach ($posts as $index => $post)
            @if ($index <= 9 && count($post->galleries)>0)
            <li class="clearfix ml-10">
                <div class="thumb">
                    <a href="{{route('single.post',[$post->category->slug,$post->slug])}}">
                        <img src="{{$post->galleries[0]->slug}}" class="h-24 w-24" alt="{{$post->title}}">
                    </a>
                </div>
                <div class="">
                    <h6><a href="{{route('single.post',[$post->category->slug,$post->slug])}}">{{substr($post->title,0,71)}}</a></h6>
                    <span class="post-on mt-0"><span class="entry-date">{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span></span>
                </div>
            </li>
            @endif
            @endforeach --}}




        </ul>
    </section>

    {{-- <section id="instagram_widget-1" class="widget instagram_widget">
        <h5 class="widget-title">Instagram</h5>
        <div class="widget-insta-feeds instafeed-gallery">
            <div class="instafeed-item">
                <a href="#" target="_blank"><img src="https://via.placeholder.com/80x80.png" alt=""></a>
            </div>
            <div class="instafeed-item">
                <a href="#" target="_blank"><img src="https://via.placeholder.com/80x80.png" alt=""></a>
            </div>
            <div class="instafeed-item">
                <a href="#" target="_blank"><img src="https://via.placeholder.com/80x80.png" alt=""></a>
            </div>
            <div class="instafeed-item">
                <a href="#" target="_blank"><img src="https://via.placeholder.com/80x80.png" alt=""></a>
            </div>
            <div class="instafeed-item">
                <a href="#" target="_blank"><img src="https://via.placeholder.com/80x80.png" alt=""></a>
            </div>
            <div class="instafeed-item">
                <a href="#" target="_blank"><img src="https://via.placeholder.com/80x80.png" alt=""></a>
            </div>
        </div>
    </section> --}}

    <section id="tag_cloud-1" class="widget widget_tag_cloud">
    <h5 class="widget-title">{{__('lang.tags')}}</h5>
        <div class="tagcloud">

            @isset($posts[0])
            @php
            $options = (object)json_decode($posts[0]->options,true);
            @endphp
            @isset($options->tags)
            @foreach ($options->tags as $option)
            <a href="{{route('search.post',$option)}}" class="tag-cloud-link">{{$option}}</a>
                @endforeach
            @endisset
            @endisset

        </div>
    </section>
</aside>


