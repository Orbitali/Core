<?php

Route::group(["namespace" => "\Orbitali\Http\Controllers", 'middleware' => ['web']], function () {

    Route::group(["as" => "panel.", "prefix" => config("orbitali.panelPrefix"), "middleware" => ["auth"]], function () {
        require_once __DIR__ . "/panel.php";
    });

    Route::group(["as" => "web."], function () {
        require_once __DIR__ . "/web.php";
    });

//    Route::fallback("");
});

