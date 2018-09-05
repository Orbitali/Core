<?php

Route::group(['middleware' => ['web']], function () {
    //region Auth & Login
    Route::get('login', 'Orbitali\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Orbitali\Http\Controllers\Auth\LoginController@login');
    Route::post('logout', 'Orbitali\Http\Controllers\Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Orbitali\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Orbitali\Http\Controllers\Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Orbitali\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Orbitali\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Orbitali\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Orbitali\Http\Controllers\Auth\ResetPasswordController@reset');

    Route::get('auth/{provider}', 'Orbitali\Http\Controllers\Auth\LoginController@redirectToProvider')->name("auth.provider");
    Route::get('auth/{provider}/callback', 'Orbitali\Http\Controllers\Auth\LoginController@handleProviderCallback')->name("auth.provider.callback");
    //endregion
});

