<?php
namespace Orbitali\Foundations\Datasources;

use Illuminate\Support\Facades\Route;

class RouteList
{
    public function source()
    {
        return collect(
            array_keys(Route::getRoutes()->getRoutesByName())
        )->mapWithKeys(function ($name) {
            return [
                $name => $name,
            ];
        });
    }
}
