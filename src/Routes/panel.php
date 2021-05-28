<?php
Route::get("/", ["uses" => "DashboardController@index", "as" => "index"]);

Route::resource("structure", "StructureController");
Route::post("/structure/{structure}/preview", [
    "uses" => "StructureController@preview",
    "as" => "structure.preview",
    "middleware" => ["can:preview,structure"],
]);

Route::resource("website", "WebsiteController");
Route::resource("user", "UserController");
Route::resource("form", "FormController");
Route::resource("url", "UrlController");
Route::resource("task", "TaskController");
Route::get("form/{formEntry}/entry", "FormEntryController@show")->name(
    "form.entry"
);
Route::resource("node", "NodeController");

Route::resource("node.page", "NodePageController", [
    "only" => ["create"],
]);
Route::resource("page", "PageController", [
    "except" => ["create"],
]);

Route::resource("node.category", "NodeCategoryController", [
    "only" => ["index", "create"],
]);
Route::resource("category", "CategoryController", [
    "except" => ["index", "create"],
]);

Route::post("/file", [
    "uses" => "FileController@upload",
    "as" => "file.upload",
    "middleware" => ["can:panel.file.upload"],
]);
