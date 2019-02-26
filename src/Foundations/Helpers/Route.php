<?php

namespace Orbitali\Foundations\Helpers;

class Route
{
    public static function isActiveRoute($route, $output = "active")
    {
        if (fnmatch($route, \Illuminate\Support\Facades\Route::currentRouteName())) return $output;
    }

    public static function areActiveRoutes(Array $routes, $output = "active")
    {
        $name = \Illuminate\Support\Facades\Route::currentRouteName();
        foreach ($routes as $route) {
            if (fnmatch($route, $name)) return $output;
        }
    }
}
