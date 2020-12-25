<aside class="shop-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12" id="primary-sidebar">
    <livewire:post-search>
        <section id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
            <h5 class="widget-title">{{ __('lang.categories') }}</h5>
            <ul class="product-categories">
                @foreach ($childCategories as $cat)
                    <li class="ml-10"><a href="{{ route('single.category', $cat->slug) }}">{{ $cat->title }}<span
                                class="posts-count">({{ count(getCategoryPosts($cat->id, 'product')) }})</span></a></li>
                @endforeach
            </ul>
        </section>




</aside>
