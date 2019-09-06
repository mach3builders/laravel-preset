<?php

namespace App\Http\Middleware;

use Closure;

class DetermineLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->locale) {
            app()->setLocale($request->user()->locale);
        } elseif (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
