<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Http\Client\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        session_start();
        if (isset($_SESSION['language'])) {
            app()->setLocale($_SESSION['language']);
        } else  {
           $locale = $this->parseLocale( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "en-US,en;q=0.9,tr;q=0.8");
            if($locale){
                app()->setLocale($locale);
            }else{
                app()->setLocale('tr');
            }
        }



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function parseLocale($locale)
    {
        $locales = config('app.locales');

        $locale = substr($locale, 0, strpos($locale, ',') ?: strlen($locale));

        if (array_key_exists($locale, $locales)) {
            return $locale;
        }

        $locale = substr($locale, 0, 2);
        if (array_key_exists($locale, $locales)) {
            $_SESSION['language'] = $locale;
            return $locale;
        }
    }

}
