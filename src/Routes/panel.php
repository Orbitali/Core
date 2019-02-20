<?php
Route::get('/', ["uses" => "DashboardController@index", "as" => "index"]);

Route::group(['as' => 'website.', 'prefix' => 'website', 'middleware' => ['can:panel.website.*']], function () {
    Route::get('/', ["uses" => "WebsiteController@index", "as" => "index"]);
});
