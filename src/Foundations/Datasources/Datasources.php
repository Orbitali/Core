<?php
namespace Orbitali\Foundations\Datasources;
use Composer\Autoload\ClassLoader;
use Illuminate\Support\Str;

class Datasources
{
    public function source()
    {
        $classes = [];
        foreach (spl_autoload_functions() as $function) {
            if (!\is_array($function)) {
                continue;
            }
            if ($function[0] instanceof ClassLoader) {
                $classes += array_filter(
                    $function[0]->getClassMap(),
                    [$this, "filter"],
                    ARRAY_FILTER_USE_KEY
                );
            }
        }
        return array_keys($classes);
    }

    private function filter($className)
    {
        return Str::startsWith($className, "App\Datasources") ||
            Str::startsWith($className, "Orbitali\Foundations\Datasources");
    }
}
