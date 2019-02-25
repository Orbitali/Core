<?php
Route::get('/', ["uses" => "DashboardController@index", "as" => "index"]);

Route::resource('website', "WebsiteController", ['middleware' => ['can:panel.website.*']]);
Route::resource('node', "NodeController", ['middleware' => ['can:panel.node.*']]);

Route::get('/{type}/{id}/structure', ["uses" => "StructureController@edit", 'as' => "structure", 'middleware' => ['can:panel.structure.edit']]);
Route::put('/{type}/{id}/structure', ["uses" => "StructureController@update", 'middleware' => ['can:panel.structure.edit']]);
Route::delete('/{type}/{id}/structure', ["uses" => "StructureController@destroy", 'middleware' => ['can:panel.structure.destroy']]);

Route::get('developer/test', function () {
    return view('Orbitali::structure.builder');
});
