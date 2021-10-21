<?php
namespace Orbitali\Foundations\Datasources;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class MenuDatasources implements IDatasource
{
    public function source()
    {
        $datasources = new Datasources();
        return $datasources->source()->filter(function ($value) {
            return is_subclass_of($value, IMenuDatasource::class);
        });
    }
}
