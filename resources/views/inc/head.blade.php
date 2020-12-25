<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
         <meta name="viewport" content="initial-scale=1.0" />
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <title>{{ $page->seo_title }}</title>
         <link rel="canonical" href="{{ env('APP_URL') }}" />
         <meta name="description" content="{{ $page->seo_description }}" />

         @isset($setting['google_site_verification'])
             <meta name="google-site-verification" href="{{ $setting['google_site_verification']->value }}" />
         @endisset
         @isset($setting['publisher'])
             <link rel="publisher" href="{{ $setting['publisher']->value }}" />
         @endisset
         @isset($setting['geo_region'])
             <meta name="geo.region" href="{{ $setting['geo_region']->value }}" />
         @endisset
         @isset($setting['geo_position'])
             <meta name="geo.position" href="{{ $setting['geo_position']->value }}" />
         @endisset
         @isset($setting['geo_placename'])
             <meta name="geo.placename" href="{{ $setting['geo_placename']->value }}" />
         @endisset
         <meta property="og:locale" content="{{ app()->getLocale() }}" />
         <meta property="og:type" content="website" />
         @isset($setting['latitude'])
             <meta property="place:location:latitude" content="{{ $setting['latitude']->value }}" />
         @endisset
         @isset($setting['longitude'])
             <meta property="place:location:longitude" content="{{ $setting['longitude']->value }}" />
         @endisset
         @isset($setting['street_address'])
             <meta property="business:contact_data:street_address" content="{{ $setting['street_address']->value }}" />
         @endisset
         @isset($setting['locality'])
             <meta property="business:contact_data:locality" content="{{ $setting['locality']->value }}" />
         @endisset
         @isset($setting['country_name'])
             <meta property="business:contact_data:country_name" content="{{ $setting['country_name']->value }}" />
         @endisset
         @isset($setting['postal_code'])
             <meta property="business:contact_data:postal_code" content="{{ $setting['postal_code']->value }}" />
         @endisset
         <meta property="business:contact_data:website" content="{{ env('APP_URL') }}" />
         @isset($setting['region'])
             <meta property="business:contact_data:region" content="{{ $setting['region']->value }}" />
         @endisset
         @isset($setting['email'])
             <meta property="business:contact_data:email" content="{{ $setting['email']->value }}" />
         @endisset
         @isset($setting['phone_number'])
             <meta property="business:contact_data:phone_number" content="{{ $setting['phone_number']->value }}" />
         @endisset
         @isset($setting['site_name'])
             <meta property="og:site_name" content="{{ $setting['site_name']->value }}" />
         @endisset
         <meta property="og:title" content="{{ $page->seo_title }}" />
         <meta property="og:description" content="{{ $page->seo_description }}" />
         <meta property="og:url" content="{{ request()->url() }}" />
         <meta property="og:image" content="{{ $page->thumbnail }}" />
         <meta property="og:image:secure_url" content="{{ $page->thumbnail }}" />
         <meta property="og:image:width" content="750" />
         <meta property="og:image:height" content="480" />
         <meta name="twitter:card" content="{{ $page->seo_title }}" />
         <meta name="twitter:description" content="{{ $page->seo_description }}" />
         <meta name="twitter:title" content="{{ $page->seo_title }}" />
         <meta name="twitter:image" content="{{ $page->thumbnail }}" />
         @isset($setting['twitter_site'])
             <meta name="twitter:site" content="{{ $setting['twitter_site']->value }}" />
         @endisset
         @isset($setting['twitter_site'])
             <meta name="twitter:creator" content="{{ $setting['twitter_site']->value }}" />
         @endisset
         @isset($setting['google_analytic'])
             {{ $setting['google_analytic']->value }}
         @endisset

         @include('inc.head-scripts')
     </head>
{{-- <body class="royal_preloader"> --}}

