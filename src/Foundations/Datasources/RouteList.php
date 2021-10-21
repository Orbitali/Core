<?php
namespace Orbitali\Foundations\Datasources;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class RouteList implements IDatasource
{
    public function source()
    {
        return Collection::wrap(Route::getRoutes()->getRoutes())
            ->filter(function ($q) {
                return !(
                    Str::contains($q->getName(), "generated::") ||
                    count($q->parameterNames()) > 0
                );
            })
            ->mapWithKeys(function ($q) {
                return [
                    $q->getName() => $q->getName(),
                ];
            });
    }
}
