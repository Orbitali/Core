<?php
namespace Orbitali\Foundations\Datasources;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Str;

class Datasources
{
    public function source()
    {
        $loader = collect(spl_autoload_functions())
            ->filter(function ($i) {
                return !is_string($i[0]) &&
                    get_class($i[0]) == ClassLoader::class;
            })
            ->first()[0];
        $dataSources = collect($loader->getClassMap())
            ->keys()
            ->filter(function ($key) {
                return Str::startsWith($key, "App\Datasources") ||
                    Str::startsWith($key, "Orbitali\Foundations\Datasources");
            });
        return $dataSources;
    }
}
