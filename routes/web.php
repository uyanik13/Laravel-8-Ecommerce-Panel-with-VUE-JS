<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\ApiPaymentController;





    Route::any('panel/{path}', function () {
        return view('layouts.vue');
        })->where('path', '(.*)');



    Route::group(['middleware' => 'web'], function () {
        Route::get('/', [PageController::class, 'index'])->name('page.home');
        Route::get('home', [PageController::class, 'index'])->name('page.home');
        Route::get('/en', [PageController::class, 'index'])->name('page.home');
        Route::get('en/blog', [PageController::class, 'blog'])->name('page.blog');
        Route::get('en/contact-us', [PageController::class, 'contact'])->name('page.contact');
        Route::get('/iletisim', [PageController::class, 'contact'])->name('page.contact');
        Route::get('/hakkimizda', [PageController::class, 'aboutUs'])->name('page.aboutUs');
        Route::get('/kurumsal-cozumlerimiz', [PageController::class, 'shop'])->name('page.shop');
        Route::get('website-seo-analizi',[PageController::class,'webSiteSeoAnalysis'])->name('page.webSiteSeoAnalysis');
        Route::get('contact',[PageController::class,'contact'])->name('page.contact');
        Route::get('our-solutions',[PageController::class,'shop'])->name('page.shop');
        Route::get('services',[PageController::class,'services'])->name('page.services');

        Route::get(trans('routes.home'), [PageController::class, 'index'])->name('page.home');
        Route::get(trans('routes.services'), [PageController::class, 'services'])->name('page.services');
        Route::get(trans('routes.about-us'), [PageController::class, 'aboutUs'])->name('page.aboutUs');
        Route::get(trans('routes.contact'), [PageController::class, 'contact'])->name('page.contact');
        Route::get(trans('routes.pricing'), [PageController::class, 'pricing'])->name('page.pricing');
        Route::get(trans('routes.portfolios'), [PageController::class, 'portfolios'])->name('page.portfolios');
        Route::get(trans('routes.blog'), [PageController::class, 'blog'])->name('page.blog');
        Route::get(trans('routes.our-solutions'), [PageController::class, 'shop'])->name('page.shop');


        Route::get(trans('routes.checkout'), [PageController::class, 'checkout'])->name('page.checkout');
        Route::get(trans('routes.cart'), [PageController::class, 'cart'])->name('page.cart');
        Route::get(trans('routes.our-team'), [PageController::class, 'ourTeam'])->name('page.ourTeam');
        Route::get(trans('routes.my-account'), [PageController::class, 'myAccount'])->name('page.myAccount');
        Route::get(trans('routes.faq'), [PageController::class, 'faq'])->name('page.faq');
        Route::get(trans('routes.page-not-found'), [PageController::class, 'pageNotFound'])->name('page.404');
        Route::get(trans('routes.login'), [PageController::class, 'login'])->name('page.login');
        Route::get(trans('routes.register'), [PageController::class, 'register'])->name('page.register');

        Route::get(trans('routes.blog') . '/{tag}', [PageController::class, 'tagPosts'])->name('page.tagPosts');
        Route::get(trans('routes.blog') . '/tag/{tag}', [PageController::class, 'tagPosts'])->name('page.tagPosts');
        Route::get(trans('routes.blog') . '/{catSlug}/{postSlug}', [PageController::class, 'singlePost'])->name('single.post');

        Route::get(trans('routes.payment') . '/{id}', [PageController::class, 'payment'])->name('page.payment');
        Route::get(trans('routes.portfolio') . '/{slug}', [PageController::class, 'singlePortfolio'])->name('single.portfolio');
        Route::get(trans('routes.product') . '/{slug}', [PageController::class, 'singleProduct'])->name('single.product');

        Route::get(trans('routes.service') . '/{slug}', [PageController::class, 'singleService'])->name('single.service');
        Route::get(trans('routes.category') . '/{slug}', [PageController::class, 'singleCategory'])->name('single.category');
        Route::get(trans('routes.search') . '/{slug}', [PageController::class, 'searchPosts'])->name('search.post');




        Route::post('/post-comment', [CommentController::class, 'store'])->name('post.comment');
        Route::post('checkout/register-or-update-info',[PageController::class,
        'checkoutRegisterOrUpdateInfo'])->name('checkout.register_or_update_info');

        Route::post('function/send-form',[PageController::class, 'sendForm'])->name('function.sendForm');
        Route::post('function/shoper-payment-callback',[ApiPaymentController::class,
        'shopierPaymentCallback'])->name('function.shopierPaymentCallback');



        Route::post('/lang/setLocale/{lang}',[PageController::class, 'setLocale'])->name('lang.setLocale');
        Route::post('/lang/changeLanguage/{lang}',[PageController::class, 'changeLanguage'])->name('lang.changeLanguage');
        Route::get('/clear-cache',function(){
        $clear = Artisan::call('optimize:clear');
        return Redirect::route('page.home')->withError(trans('lang.cache_cleared'));
        });
        Route::get('sitemap', [PageController::class, 'sitemap'])->name('sitemap');
        Route::get('email-template', [PageController::class, 'emailTemplate'])->name('email.template');

    });

     Route::group(['middleware' => ['guest:api']], function () {
       Route::post('function/login',[PageController::class, 'loginFunction'])->name('function.login');
        Route::post('function/register',[PageController::class, 'registerFunction'])->name('function.register');

    });
