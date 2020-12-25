<section class="related products">
    <h2 class="text-5xl font-bold">{{__('lang.related_products')}}</h2>
        <ul class="products columns-4">
          @foreach ($relatedProducts as $key => $relatedProduct)
          @if ($relatedProduct->id !== $page->id)
          <li class="product {{($key+1) / 3 == 1 ? 'last' : ''}}">
            <div class="product-media">
                @if ($relatedProduct->discounted_price > 0 )
                <span class="onsale">Sale!</span>
                @endif
                <img src="{{$relatedProduct->thumbnail}}" alt="{{$relatedProduct->title}}">
                <div class="wrapper-add-to-cart">
                 @livewire('shopping-cart-add-button', ['product' => $relatedProduct, 'quantity' => 1])
                </div>
            </div>
        <h2 class="woocommerce-loop-product__title"><a href="{{route('single.product',$relatedProduct->slug)}}">{{substr($relatedProduct->title,0,25)}}</a></h2>
            <div class="star-rating">
                <span><i class="fa fa-star"></i></span>
                <span><i class="fa fa-star"></i></span>
                <span><i class="fa fa-star"></i></span>
                <span><i class="fa fa-star"></i></span>
                <span><i class="fa fa-star"></i></span>
            </div>
            <span class="price">
                @if ($relatedProduct->discounted_price > 0 )
                <del>
                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{$currency}}</span>{{$relatedProduct->price}}</span>
                </del>

                <ins>
                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{$currency}}</span>{{$relatedProduct->discounted_price}}</span>
                </ins>
                @else
                <ins>
                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{$currency}}</span>{{$relatedProduct->price}}</span>
                </ins>

                @endif
            </span>
        </li>
          @endif
          @endforeach


        </ul>
    </section>
