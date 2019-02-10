<?php

Route::group(["namespace" => "\Orbitali\Http\Controllers", "middleware" => ["web"]], function () {

    Route::group(
        [
            "as" => "panel.",
            "prefix" => config("orbitali.panelPrefix"),
            "middleware" => ["auth", "can:panel.dashboard.view"]
        ], function () {
        require_once __DIR__ . "/panel.php";
    });

    //region Auth & Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    if (config("orbitali.registerActivity")) {
        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');
    }

    if (config("orbitali.passwordResetActivity")) {
        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
            ->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
            ->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')
            ->name("auth.provider");
        Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback')
            ->name("auth.provider.callback");
    }
    //endregion
});
