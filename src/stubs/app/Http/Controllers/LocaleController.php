<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Change the language/locale
     */
    public function change(Request $request)
    {
        if (in_array($request->locale, config('app.locales'))) {
            app()->setLocale($request->locale);
            session(['locale' => $request->locale]);
        }

        return redirect()->back();
    }
}
