<footer id="site-footer" class="site-footer site-footer-2 bg-gradient-2">
    <div class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <img src="{{ $setting['white_logo']->value }}" class="attachment-full size-full m-b25"
                            alt="{{ __('lang.dijitalreklamorg') }}">
                        <p class="m-b30">{{ __('lang.about_dro_short') }}</p>
                        <div class="footer-social">
                            @isset($setting['instagram'])
                                <a class="footer-social-icon instagram" href="{{ $setting['instagram']->value }}"
                                    target="_blank"><i class="fab fa-instagram"></i></a>
                            @endisset

                            @isset($setting['twitter'])
                                <a class="footer-social-icon twitter" href="{{ $setting['twitter']->value }}"
                                    target="_blank"><i class="fab fa-twitter"></i></a>
                            @endisset

                            @isset($setting['facebook'])
                                <a class="footer-social-icon facebook" href="{{ $setting['facebook']->value }}"
                                    target="_blank"><i class="fab fa-facebook"></i></a>
                            @endisset

                            @isset($setting['linkedin'])
                                <a class="footer-social-icon linkedin" href="{{ $setting['linkedin']->value }}"
                                    target="_blank"><i class="fab fa-linkedin"></i></a>
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <h5>{{ __('lang.contact_details') }}</h5>
                        <div class="footer-contact-2">
                            <ul class="font-second">
                                @isset($setting['address'])
                                    <li><strong>{{ __('lang.address') }}: </strong>{{ $setting['address']->value }}</li>
                                @endisset

                                @isset($setting['email'])
                                    <li><strong>{{ __('lang.email') }}: </strong>{{ $setting['email']->value }}</li>
                                @endisset

                                @isset($setting['phone'])
                                    <li><strong>{{ __('lang.phone') }}: </strong>{{ $setting['phone']->value }}</li>
                                @endisset



                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <h5>{{ ucwords(__('routes.services')) }}</h5>
                        <ul class="ft-menu-list">
                            @foreach (getPosts('service') as $item)
                                <li class="ft-menu-item">
                                    <a href="{{ route('single.service', $item->slug) }}">{{ $item->title }}</a>
                                </li>
                            @endforeach
                            <a href="{{ route('sitemap') }}">Sitemap</a>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <h5>{{__('lang.subscription')}}</h5>
                        <div class="widget-insta-feeds instafeed-gallery">
                            <form action="{{ route('function.sendForm') }}" method="post" class="wpcf7-form" id="contact_form">
                            @csrf
                                <div class="seo-score one-line-form">
                                <span class="wpcf7-form-control-wrap your-email">
                                    <input type="email" wire:model.debounce.500ms="email" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email" placeholder="{{ __('lang.place_holder_email') }}" required="">
                                </span>
                                 <button type="submit"  class="octf-btn">{{ __('lang.send') }}</button>
                             </div>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="copyright-2 text-center">{{ __('lang.copyright') }}</p>

        </div>
    </div>
</footer><!-- #site-footer -->
</div>
<a id="back-to-top" href="#" class="show"><i class="flaticon-arrow-pointing-to-up"></i></a>
