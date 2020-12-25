<div class="woocommerce">
    <div class="row">
        <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
            <form class="woocommerce-cart-form" action="" method="post">
                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                    <thead>
                        <tr>
                            <th class="product-remove">{{ __('lang.action') }}</th>
                            <th class="product-thumbnail">{{ __('lang.thumbnail') }}</th>
                            <th class="product-name">{{ __('lang.product') }}</th>
                            <th class="product-price">{{ __('lang.price') }}</th>
                            <th class="product-quantity">{{ __('lang.quantity') }}</th>
                            <th class="product-subtotal">{{ __('lang.sub_total') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cart as $item)
                            <tr class="woocommerce-cart-form__cart-item cart_item">
                                <td class="product-remove">
                                    <a href="#" wire:click="removeFromCart({{ $item->post->id }})" class="remove">×</a>
                                </td>
                                <td class="product-thumbnail">
                                    <a href="{{ route('single.product', $item->post->slug) }}">
                                        <img class="ml-6" src="{{ $item->post->thumbnail }}"
                                            alt="{{ $item->post->title }}">
                                    </a>
                                </td>
                                <td class="product-name" data-title="Product">
                                    <a
                                        href="{{ route('single.product', $item->post->slug) }}">{{ $item->post->title }}</a>
                                </td>
                                <td class="product-price" data-title="Price">
                                    <span class="woocommerce-Price-amount amount"><span
                                            class="woocommerce-Price-currencySymbol">{{ $currency }}</span>{{ $item->post->discounted_price ? $item->post->discounted_price : $item->post->price }}</span>
                                </td>
                                <td class="product-quantity" data-title="Quantity">
                                    {{-- <div class="quantity">
                                        <input type="number" id="quantity" class="input-text qty text"
                                            inputmode="numeric">
                                    </div> --}}
                                    <div class="quantity">
                                        <input type="text" id="quantity" disabled class="input-text qty text"
                                            value="{{ $item->quantity }}">
                                    </div>
                                </td>

                                <td class="product-subtotal" data-title="Subtotal">
                                    <span class="woocommerce-Price-amount amount"><span
                                            class="woocommerce-Price-currencySymbol">{{ $currency }}</span>{{ $item->quantity * ($item->post->discounted_price ? $item->post->discounted_price : $item->post->price) }}</span>
                                </td>
                            </tr>

                        @endforeach
                        {{-- <tr>
                            <td colspan="6" class="actions">
                                <div class="coupon">
                                    <label for="coupon_code">{{ __('lang.coupon') }}:</label>
                                    <input type="text" name="coupon_code" class="input-text" value=""
                                        placeholder="{{ __('lang.coupon_code') }}">
                                    <button class="button" name="apply_coupon">{{ __('lang.apply_coupon') }}</button>
                                </div>
                                <button type="submit" class="button" name="update_cart" value="Update cart"
                                    disabled="">{{ __('lang.update_cart') }}</button>
                                <input type="hidden" id="woocommerce-cart-nonce" name="woocommerce-cart-nonce"
                                    value="74e4341da8"><input type="hidden" name="_wp_http_referer" value="/onum/cart/">
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </form>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="cart_totals ">
                <h2 class="mb-10">{{ __('lang.cart_totals') }}</h2>
                <table cellspacing="0" class="shop_table shop_table_responsive">
                    <tbody>
                        <tr class="cart-subtotal">
                            <th>{{ __('lang.sub_total') }}</th>
                            <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span
                                        class="woocommerce-Price-currencySymbol">{{ $currency }}</span>{{ $cartTotal }}</span>
                            </td>
                        </tr>
                        <tr class="woocommerce-shipping-totals shipping">
                            <th>{{ __('lang.shipping') }}</th>
                            <td data-title="Shipping">
                                <ul id="shipping_method" class="woocommerce-shipping-methods">
                                    <li>
                                        <input type="hidden" name="shipping_method[0]" data-index="0"
                                            id="shipping_method_0_flat_rate1" value="flat_rate:1"
                                            class="shipping_method">
                                        <span
                                            class="woocommerce-Price-currencySymbol">{{ $currency }}</span>00.00</span></label>
                                    </li>
                                </ul>

                            </td>
                        </tr>
                        <tr class="tax-total">
                            <th>{{ __('lang.tax') }}</th>
                            <td data-title="Tax"><span class="woocommerce-Price-amount amount"><span
                                        class="woocommerce-Price-currencySymbol">{{ $currency }}</span>00.00</span></td>
                        </tr>
                        <tr class="order-total">
                            <th>{{ __('lang.total') }}</th>
                            <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span
                                            class="woocommerce-Price-currencySymbol">{{ $currency }}</span>{{ $cartTotal }}</span></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="wc-proceed-to-checkout">
                    <a href="{{ route('page.checkout') }}"
                        class="checkout-button button alt wc-forward">{{ __('lang.proceed_to_checkout') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
