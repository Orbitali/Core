<?php

Route::get("/", function () {
    return var_export(\request()->fullUrl(),true);
});

