<?php
Route::get("/", ["uses" => "DashboardController@index", "as" => "index"]);

//region Structure
Route::get("/structure", [
    "uses" => "StructureController@index",
    "as" => "structure.index",
    "middleware" => ["can:panel.structure.index"],
]);
Route::get("/structure/create", [
    "uses" => "StructureController@create",
    "as" => "structure.create",
    "middleware" => ["can:panel.structure.create"],
]);
Route::get("/structure/{id}", [
    "uses" => "StructureController@show",
    "as" => "structure.show",
    "middleware" => ["can:panel.structure.show"],
]);
Route::post("/preview/structure", [
    "uses" => "StructureController@preview",
    "as" => "structure.preview",
    "middleware" => ["can:panel.structure.preview"],
]);
Route::get("/{type}/{id}/structure", [
    "uses" => "StructureController@edit",
    "as" => "structure.edit",
    "middleware" => ["can:panel.structure.edit"],
]);
Route::put("/{type}/{id}/structure", [
    "uses" => "StructureController@update",
    "as" => "structure.update",
    "middleware" => ["can:panel.structure.update"],
]);
Route::delete("/{type}/{id}/structure", [
    "uses" => "StructureController@destroy",
    "as" => "structure.destroy",
    "middleware" => ["can:panel.structure.destroy"],
]);
//endregion
Route::resource("website", "WebsiteController", [
    "middleware" => ["can:panel.website.*"],
]);
Route::resource("node", "NodeController", [
    "middleware" => ["can:panel.node.*"],
]);

Route::resource("page", "PageController", [
    "middleware" => ["can:panel.page.*"],
]);

Route::post("/file", [
    "uses" => "FileController@upload",
    "as" => "file.upload",
    "middleware" => ["can:panel.file.upload"],
]);

//TODO:fix form
/*Route::resource("form", "FormController", [
    "middleware" => ["can:panel.form.*"],
]);*/
