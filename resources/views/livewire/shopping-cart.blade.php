
    <div class="octf-header-module cart-btn-hover">
       <div class="h-cart-btn octf-cta-icons">
            <a class="cart-contents" href="{{route('page.cart')}}" title="{{__('lang.view_your_shopping_cart')}}"><i class="flaticon-supermarket"></i>
            <span class="count">{{count($cart) ? count($cart) : '0'}}</span>
            </a>
        </div>

        @isset($cart)
        <div class="site-header-cart">
            <div class="widget woocommerce widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                        @foreach ($cart as $item)
                        <li class="woocommerce-mini-cart-item mini_cart_item">
                            <a wire:click="removeFromCart({{$item->post->id}})" class="remove remove_from_cart_button">×</a>
                            <a href="{{route('single.product',$item->post->id)}}">
                                <img src="{{$item->post->thumbnail}}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="{{$item->post->title}}">{{substr($item->post->title,0,20)}}</a>
                                <span class="quantity">{{$item->quantity}} × <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{  $currency }}  </span>{{$item->post->discounted_price ? $item->post->discounted_price : $item->post->price }}</span></span>
                        </li>
                        @endforeach
                    </ul>
                    @if (count($cart)>0)
                    <p class="woocommerce-mini-cart__total total">
                        <strong>{{__('lang.total')}}:</strong> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{  $currency }}</span>{{$cartTotal}}</span>
                    </p>
                    <p class="woocommerce-mini-cart__buttons buttons flex">
                        <a href="{{route('page.cart')}}" class="button wc-forward">{{__('lang.view_cart')}}</a>
                        <a href="{{route('page.checkout')}}" class="button checkout wc-forward">{{__('lang.checkout')}}</a>
                    </p>
                    @else
                    <p class="woocommerce-mini-cart__empty-message">{{__('lang.there_is_not_product_in_cart')}}</p>
                    @endif
                </div>



            </div>
        </div>
        @endisset

    </div>




