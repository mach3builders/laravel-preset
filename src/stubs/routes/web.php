<?php

/**
 * Authentication routes
 */

// login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// registration
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('register/activate/{id}/{token}', 'Auth\RegisterController@activateRegistration')->name('activate-registration');

// password reset
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot-password');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset-password');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// change language
Route::get('change-locale/{locale}', 'LocaleController@change')->name('change-locale');


/**
 * Main routes
 * All protected with a middleware
 */

Route::middleware(['auth', 'verified', 'locale'])->group(function () {

    // home dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // users
    Route::resource('users', 'UserController', ['except' => 'show']);
});
