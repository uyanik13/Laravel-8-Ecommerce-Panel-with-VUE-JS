
@section('body-class'){{'woocommerce'}}@endsection
@extends('layouts.inner-page-layout')

@section('inner-content')
<div id="content" class="site-content">
      <div class="page-header dtable text-center" style="background-image: url(/theme/dro-v1/images/bg-page-header.jpg);">
          <div class="dcell">
              <div class="container">
                  <h1 class="page-title-tw">{{ucwords($page->title)}}</h1>
                  <ul id="breadcrumbs" class="breadcrumbs">
                      <li><a href="/">{{__('lang.home')}}</a></li>
                      <li class="active">{{ucwords($page->title)}}</li>
                  </ul>
              </div>
          </div>
      </div>

      <div class="content-product-wrapper">
          <div class="container">
              <div class="row">
                  <div id="primary" class="content-area col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
                      <main id="main" class="site-main">
                          {{-- <div class="woocommerce-notices-wrapper"></div>
                          <p class="woocommerce-result-count">Showing 1–9 of 12 results</p>
                          <form class="woocommerce-ordering" method="get">
                              <select name="orderby" class="orderby" aria-label="Shop order">
                                      <option value="menu_order" selected="selected">Default sorting</option>
                                      <option value="popularity">Sort by popularity</option>
                                      <option value="rating">Sort by average rating</option>
                                      <option value="date">Sort by latest</option>
                                      <option value="price">Sort by price: low to high</option>
                                      <option value="price-desc">Sort by price: high to low</option>
                              </select>
                              <input type="hidden" name="paged" value="1">
                          </form> --}}
                          <ul class="products columns-3">
                              @foreach ($products as $key => $product)
                              <li class="product {{($key+1) / 3 == 1 ? 'last' : ''}}">
                                  <div class="product-media">
                                      @if ($product->discounted_price > 0 )
                                      <span class="onsale">Sale!</span>
                                      @endif
                                      <img src="{{$product->thumbnail}}" alt="{{$product->title}}">
                                      <div class="wrapper-add-to-cart">
                                       @livewire('shopping-cart-add-button', ['product' => $product, 'quantity' => 1,'class'=> 'button product_type_simple add_to_cart_button ajax_add_to_cart octf-btn octf-btn-primary octf-btn-icon'])
                                      </div>
                                  </div>
                              <h2 class="woocommerce-loop-product__title"><a href="{{route('single.product',$product->slug)}}">{{substr($product->title,0,25)}}</a></h2>
                                  <div class="star-rating">
                                      <span><i class="fa fa-star"></i></span>
                                      <span><i class="fa fa-star"></i></span>
                                      <span><i class="fa fa-star"></i></span>
                                      <span><i class="fa fa-star"></i></span>
                                      <span><i class="fa fa-star"></i></span>
                                  </div>
                                  <span class="price">
                                      @if ($product->discounted_price > 0 )
                                      <del>
                                          <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{$currency}}</span>{{$product->price}}</span>
                                      </del>

                                      <ins>
                                          <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{$currency}}</span>{{$product->discounted_price}}</span>
                                      </ins>
                                      @else
                                      <ins>
                                          <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{$currency}}</span>{{$product->price}}</span>
                                      </ins>

                                      @endif
                                  </span>
                              </li>
                              @endforeach


                          </ul>
                          <nav class="wc-pagination">
                              {{$products->links('vendor.pagination.theme')}}
                          </nav>
                      </main>
                  </div>
                  @include('components.product-sidebar')
              </div>
          </div>
      </div>

@endsection

