<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {




        if ($request->session()->exists('language')) {
            app()->setLocale(session('language'));
        } else  {
            $locale = $this->parseLocale($request);
            if($locale){
                app()->setLocale($locale);
            }else{
                //app()->setLocale('tr');
                app()->setLocale('tr');
            }
        }


        //dd(app()->getLocale());
        return $next($request);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function parseLocale($request)
    {
        $locales = config('app.locales');

        $locale = $request->server('HTTP_ACCEPT_LANGUAGE');
        $locale = substr($locale, 0, strpos($locale, ',') ?: strlen($locale));



        if (array_key_exists($locale, $locales)) {
            return $locale;
        }

        $locale = substr($locale, 0, 2);
        if (array_key_exists($locale, $locales)) {
            $request->session()->put('language', $locale);
            return $locale;
        }
    }
}
