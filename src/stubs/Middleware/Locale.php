<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Closure;
use Carbon\Carbon;

class Locale
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            $locale = Auth::user()->locale;
        } else {
            $server_locale = strtolower(explode('-', Request::server('HTTP_ACCEPT_LANGUAGE'))[0]) ?? app()->getLocale();
            $locale = Cookie::get('locale') ?? $server_locale;
        }

        if (in_array($locale, config('app.locales'))) {
            app()->setLocale($locale);
            Carbon::setLocale($locale);
        }

        return $next($request);
    }
}
