<?php

Route::group(
    ["namespace" => "\Orbitali\Http\Controllers", "middleware" => ["web"]],
    function () {
        Route::group(
            [
                "as" => "panel.",
                "prefix" => config("orbitali.panelPrefix"),
                "middleware" => [
                    "auth",
                    "localization",
                    "can:panel.dashboard.view",
                ],
            ],
            function () {
                require __DIR__ . "/panel.php";
            }
        );

        Route::get("sitemap.xml", "SiteMapController@sitemapIndex");
        Route::get("sitemap-{page}.xml", "SiteMapController@urlSet")->name(
            "website.sitemap"
        );

        //region Auth & Login
        Route::get("login", "Auth\LoginController@showLoginForm")->name(
            "login"
        );
        Route::post("login", "Auth\LoginController@login");
        Route::get(
            "login/{provider}",
            "Auth\LoginController@redirectToProvider"
        )->name("auth.provider");
        Route::get(
            "login/{provider}/callback",
            "Auth\LoginController@handleProviderCallback"
        )->name("auth.provider.callback");
        Route::post("logout", "Auth\LoginController@logout")->name("logout");

        Route::get(
            "password/confirm",
            "Auth\ConfirmPasswordController@showConfirmForm"
        )->name("password.confirm");
        Route::post(
            "password/confirm",
            "Auth\ConfirmPasswordController@confirm"
        );

        if (config("orbitali.registerActivity")) {
            // Registration Routes...
            Route::get(
                "register",
                "Auth\RegisterController@showRegistrationForm"
            )->name("register");
            Route::post("register", "Auth\RegisterController@register");

            Route::get(
                "email/verify",
                "Auth\VerificationController@show"
            )->name("verification.notice");
            Route::get(
                "email/verify/{id}/{hash}",
                "Auth\VerificationController@verify"
            )->name("verification.verify");
            Route::post(
                "email/resend",
                "Auth\VerificationController@resend"
            )->name("verification.resend");
        }

        if (config("orbitali.passwordResetActivity")) {
            // Password Reset Routes...
            Route::get(
                "password/reset",
                "Auth\ForgotPasswordController@showLinkRequestForm"
            )->name("password.request");
            Route::post(
                "password/email",
                "Auth\ForgotPasswordController@sendResetLinkEmail"
            )->name("password.email");
            Route::get(
                "password/reset/{token}",
                "Auth\ResetPasswordController@showResetForm"
            )->name("password.reset");
            Route::post("password/reset", "Auth\ResetPasswordController@reset");
        }
        //endregion
    }
);
