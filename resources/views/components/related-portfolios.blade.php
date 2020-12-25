<div class="portfolio-related-posts-wrap">
    <div class="portfolio-related-title-wrap">
        <h2 class="text-5xl font-bold">{{__('lang.related_projects')}}</h2>
    </div>
    <div class="portfolio-related-posts projects-grid">


    @foreach ($relatedPortfolios as $key => $relatedPortfolio)
    @if ($relatedPortfolio->id !== $page->id)
    <div class="project-item {{($key+1) / 3 == 1 ? 'last' : ''}}">
        <div class="projects-box">
            <div class="projects-thumbnail">
                <a href="{{route('single.portfolio',$relatedPortfolio->slug)}}">
                <img src="{{$relatedPortfolio->thumbnail}}" class="" alt="{{$relatedPortfolio->title}}">
                </a>
            </div>
            <div class="portfolio-info">
                <div class="portfolio-info-inner">
                    <h5><a href="{{route('single.portfolio',$relatedPortfolio->slug)}}">{{$relatedPortfolio->title}}</a></h5>
                    <p class="portfolio-cates"><a href="#">Development</a><span>/</span></p>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach

    </div>
</div>
