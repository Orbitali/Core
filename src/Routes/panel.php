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
Route::resource("menu", "MenuController");
Route::post("/task/{task}/run", [
    "uses" => "TaskController@run",
    "as" => "task.run",
    "middleware" => ["can:run,task"],
]);
Route::get("/task/{task}/download/{logId}/{attachmentId}/{fileId}", [
    "uses" => "TaskController@download",
    "as" => "task.download",
    "middleware" => ["can:download,task"],
]);
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

Route::get("clockwork/app","\Clockwork\Support\Laravel\ClockworkController@webIndex")->name("clockwork");
Route::get("clockwork/{path}","\Clockwork\Support\Laravel\ClockworkController@webAsset")->where("path", ".+")->withoutMiddleware(['auth', "can:panel.dashboard.view"]);
Route::get("__clockwork/{id}/extended","\Clockwork\Support\Laravel\ClockworkController@getExtendedData")->where("id", "([0-9-]+|latest)")->withoutMiddleware(['auth', "can:panel.dashboard.view"]);
Route::get("__clockwork/{id}/{direction?}/{count?}","\Clockwork\Support\Laravel\ClockworkController@getData")->where("id", "([0-9-]+|latest)")->where("direction", "(next|previous)")->where("count", "\d+")->withoutMiddleware(['auth', "can:panel.dashboard.view"]);
Route::put("__clockwork/{id}","\Clockwork\Support\Laravel\ClockworkController@updateData")->withoutMiddleware(['auth', "can:panel.dashboard.view", "App\Http\Middleware\VerifyCsrfToken"]);
Route::post("__clockwork/auth","\Clockwork\Support\Laravel\ClockworkController@authenticate")->withoutMiddleware(['auth', "can:panel.dashboard.view", "App\Http\Middleware\VerifyCsrfToken"]);
