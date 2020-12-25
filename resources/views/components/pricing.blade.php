<section class="p-t120 p-b290 bg-pricing">
    <div class="container">
        <div class="ot-heading text-center">
            <h6><span>{{ __('lang.choose_your_plan') }}</span></h6>
            <h2 class="main-heading">{{ __('lang.flexible_pricing_plans') }}</h2>
        </div>
        <p class="text-center m-b40">{!! __('lang.pricing_desc_on_homepgae') !!}</p>
        <div class="row">
            @foreach ($packages as $package)
                <div class="col-md-4">
                    <div class="ot-pricing-table bg-shape s{{ rand(1, 3) }}">
                        <span class="title-table">{{ $package->title }}</span>
                        <div class="inner-table">
                            <img src="{{ $package->thumbnail }}" alt="{{ $package->second_title }}">
                            <h2><sup>$</sup> {{ $package->monthly_price }}</h2>
                            <p>{{ __('lang.monthly_price') }}</p>
                            <div class="details">
                                <ul>
                                    @foreach ($package->description as $feature)
                                        <li>{{ $feature['value'] }}</li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <a href="{{ route('page.shop') }}"
                            class="octf-btn octf-btn-icon octf-btn-primary">{{ __('lang.see_details') }}<i
                                class="flaticon-right-arrow-1"></i></a>
                    </div>
                </div><!-- End of the col-md-4 -->
            @endforeach
        </div>
    </div>
</section>
