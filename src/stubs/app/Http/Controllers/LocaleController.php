<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * Change the language/locale
     */
    public function change($locale)
    {
        $cookie = null;

        if (in_array($locale, config('app.locales'))) {
            $cookie = Cookie::forever('locale', $locale);
        }

        return redirect()->back()->cookie($cookie);
    }
}
