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
Route::post("/task/{task}/run", [
    "uses" => "TaskController@run",
    "as" => "task.run",
    "middleware" => ["can:run"],
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
Route::get("clockwork/{path}","\Clockwork\Support\Laravel\ClockworkController@webAsset")->where("path", ".+");
Route::get("__clockwork/{id}/extended","\Clockwork\Support\Laravel\ClockworkController@getExtendedData")->where("id", "([0-9-]+|latest)");
Route::get("__clockwork/{id}/{direction?}/{count?}","\Clockwork\Support\Laravel\ClockworkController@getData")->where("id", "([0-9-]+|latest)")->where("direction", "(next|previous)")->where("count", "\d+");
Route::put("__clockwork/{id}","\Clockwork\Support\Laravel\ClockworkController@updateData");
Route::post("__clockwork/auth","\Clockwork\Support\Laravel\ClockworkController@authenticate");
//
Route::get("demo/{structure}", function () {
    $website = orbitali("website");
    $website->loadMissing(["extras", "details.extras", "details.url"]);
    $website->structure;
    view()->share("model",$website);
    return view("Orbitali::structure.model_edit_new",["update_route"=>"panel.demo.update","title"=>"Demo Page"]);
});

Route::put("demo/{structure}", function(\Illuminate\Http\Request $request){
    $request->validate([
        "details.*.name" => "required",
        "domain" => "required",
        "languages" => "required|array|min:2",
    ]);
})->name("demo.update");
