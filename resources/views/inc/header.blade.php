<body class="@yield('body-class', '')">
<div id="page" class="site">
@php
$menus = findCustomData('Menu');
$locales = config('app.locales');
@endphp
<header id="site-header"
    class="@yield('header','site-header header-style-1 header-overlay header-fullwidth sticky-header')">
    <!-- Main Header start -->
    <div class="octf-main-header">
        <div class="octf-area-wrap">
            <div class="container-fluid octf-mainbar-container">
                <div class="octf-mainbar">
                    <div class="octf-mainbar-row octf-row">
                        <!-- logo start -->
                        <div class="octf-col">
                            <div id="site-logo" class="site-logo">
                                <a href="{{ route('page.home') }}">
                                    <img class="logo-static"
                                        src="@isset($setting['logo']) {{ $setting['logo']->value }} @endisset"
                                        alt="@isset($setting['site_name']) {{ $setting['site_name']->value }} @endisset">
                                    <img class="logo-scroll"
                                        src="@isset($setting['white_logo']) {{ $setting['white_logo']->value }} @endisset"
                                        alt="@isset($setting['site_name']) {{ $setting['site_name']->value }} @endisset">
                                </a>
                            </div>
                        </div>
                        <!-- logo start -->

                        {{-- <li
                            class="menu-item-has-children current-menu-item current-menu-ancestor"><a
                                href="index.html">Home</a>
                            <ul class="sub-menu">
                                <li class="current-menu-item"><a href="index.html">Main Home</a></li>
                                --}}
                                <!-- nav start -->
                                <div class="octf-col">
                                    <nav id="site-navigation" class="main-navigation">
                                        <ul id="primary-menu" class="menu">
                                            @isset($menus)
                                                @foreach ($menus as $menu)
                                                    @php
                                                    $page = findPage($menu['data']);
                                                    @endphp
                                                    @isset($page)
                                                        <li
                                                            class="{{ $menu['subMenuData'] ? 'menu-item-has-children current-menu-item current-menu-ancestor' : '' }}">
                                                            <a href="/{{ $page->slug }}">{{ ucwords($page->title) }} </a>
                                                            @if ($menu['subMenuData'])
                                                                <ul class="sub-menu">
                                                                    @foreach ($menu['subMenu'] as $subMenu)
                                                                        @php
                                                                        $subPage = findPage($subMenu['data']);
                                                                        @endphp
                                                                        <li><a href="/{{ $subPage->slug }}">
                                                                                {{ ucwords($subPage->title) }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endisset
                                                @endforeach
                                            @endisset

                                            <li class="menu-item-has-children">
                                                <a href="#">{{ __('lang.' . app()->getLocale()) }}<i
                                                        class="la la-angle-down"></i></a>
                                                <ul class="sub-menu flex">

                                                    @foreach ($locales as $locale)
                                                    <form action="{{ route('lang.changeLanguage', $locale) }}"
                                                        method="POST" id="change-to-{{$locale}}">
                                                        @csrf
                                                        <li onclick="document.getElementById('change-to-{{$locale}}').submit();"
                                                            class="flag-item">
                                                            <a href="#"> <img src="/images/flags/{{$locale}}.png"
                                                                    alt="{{ __('lang.'.$locale) }}" class="mt-2">
                                                                {{ __('lang.'.$locale) }}</a>
                                                        </li>
                                                    </form>
                                                    @endforeach
                                                </ul>
                                            </li>

                                        </ul>
                                    </nav><!-- #site-navigation -->
                                </div>

                                <div class="octf-col text-right">

                                    <!-- Call To Action -->
                                    <div class="octf-btn-cta">
                                        @livewire('shopping-cart')
                                        <div class="octf-header-module">
                                            <div class="btn-cta-group btn-cta-header">
                                                <a class="octf-btn octf-btn-third"
                                                    href="{{ route('page.contact') }}">{{ __('lang.get_contact_us') }}</a>
                                            </div>
                                        </div>
                                        <div class="octf-header-module">
                                            <div class="toggle_search octf-cta-icons">
                                                <i class="flaticon-search"></i>
                                            </div>
                                            <!-- Form Search on Header -->
                                            <div class="h-search-form-field">
                                                <div class="h-search-form-inner">
                                                            @livewire('post-search')
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header mobile -->
    <div class="header_mobile">
        <div class="container">
            <div class="mlogo_wrapper clearfix">

                <!-- logo mobile start -->
                <div class="mobile_logo">
                    <a href="{{ route('page.home') }}"><img
                            src="@isset($setting['logo']) {{ $setting['logo']->value }} @endisset"
                            alt="@isset($setting['site_name']) {{ $setting['site_name']->value }} @endisset"></a>
                </div>
                <!-- logo mobile end -->

                <!-- cart mobile start -->
                <div class="octf-btn-cta">
                    @livewire('shopping-cart')
                </div>

                <!-- cart mobile end -->

                <div id="mmenu_toggle">
                    <button></button>
                </div>

            </div>

            <!-- nav mobile start -->
            <div class="mmenu_wrapper">
                <div class="mobile_nav">
                    <ul id="menu-main-menu" class="mobile_mainmenu">
                        @isset($menus)
                            @foreach ($menus as $menu)
                                @php
                                $page = findPage($menu['data']);
                                @endphp
                                @isset($page)
                                    <li class="{{ $menu['subMenuData'] ? 'menu-item-has-children' : '' }}">
                                        <a href="/{{ $page->slug }}"> {{ ucwords($page->title) }} </a>
                                        @if ($menu['subMenuData'])
                                            <ul class="sub-menu">
                                                @foreach ($menu['subMenu'] as $subMenu)
                                                    @php
                                                    $subPage = findPage($subMenu['data']);
                                                    @endphp
                                                    <li><a href="/{{ $subPage->slug }}"> {{ ucwords($subPage->title) }} </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endisset
                            @endforeach
                        @endisset
                        <li class="menu-item-has-children">
                            <a href="#">{{ __('lang.' . app()->getLocale()) }}<i
                                    class="la la-angle-down"></i></a>
                            <ul class="sub-menu flex">


                                @foreach ($locales as $locale)
                                <form action="{{ route('lang.changeLanguage', $locale) }}"
                                    method="POST" id="change-to-{{$locale}}">
                                    @csrf
                                    <li onclick="document.getElementById('change-to-{{$locale}}').submit();"
                                        class="flag-item">
                                        <a href="#"> <img src="/images/flags/{{$locale}}.png"
                                                alt="{{ __('lang.'.$locale) }}" class="mt-2">
                                            {{ __('lang.'.$locale) }}</a>
                                    </li>
                                </form>
                                @endforeach



                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- nav mobile end -->
        </div>
    </div>
</header>
