<div class="related-posts">
    <h2 class="text-5xl font-bold">{{ __('lang.related_posts') }}</h2>
    <div class="row">
        @foreach ($relatedPosts as $index => $relatedPost)
            @if ($relatedPost->id !== $page->id && $index < 2)
                <div class="col-md-6">
                    <div class="post-box post-item">
                        <div class="post-inner">
                            <div class="entry-media">
                                <div class="post-cat">
                                    <span class="posted-in"><a
                                            href="{{ route('single.category', $relatedPost->category->slug) }}">{{ $relatedPost->category->title }}</a></span>
                                </div>
                                <a
                                    href="{{ route('single.post', [$relatedPost->category->slug, $relatedPost->slug]) }}"><img
                                        src="{{ $relatedPost->thumbnail }}" alt="{{ $relatedPost->title }}"></a>
                            </div>
                            <div class="inner-post">
                                <div class="entry-header">
                                    <div class="entry-meta">
                                        <span class="byline">
                                            <a class="url fn n"
                                                href="{{ route('single.post', [$relatedPost->category->slug, $relatedPost->slug]) }}"><i
                                                    class="flaticon-user"></i> {{ $relatedPost->user->name }}</a>
                                        </span>
                                        <span class="posted-on">
                                            <a
                                                href="{{ route('single.post', [$relatedPost->category->slug, $relatedPost->slug]) }}"><i
                                                    class="flaticon-clock"></i>
                                                <time
                                                    class="entry-date published">{{ \Carbon\Carbon::parse($relatedPost->created_at)->diffForHumans() }}</time>
                                            </a>
                                        </span>
                                    </div>
                                    <h4 class="entry-title"><a
                                            href="{{ route('single.post', [$relatedPost->category->slug, $relatedPost->slug]) }}">{{ $relatedPost->title }}</a>
                                    </h4>
                                </div><!-- .entry-header -->
                                <div class="the-excerpt">{{ substr(strip_tags($relatedPost->content), 0, 250) }}...
                                </div><!-- .entry-content -->
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        @endforeach

    </div>
</div>
