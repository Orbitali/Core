<?php
Route::get('/', ["uses" => "DashboardController@index", "as" => "index"]);

Route::resource('website', "WebsiteController", ['middleware' => ['can:panel.website.*']]);

