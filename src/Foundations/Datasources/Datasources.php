<?php
namespace Orbitali\Foundations\Datasources;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Datasources implements IDatasource
{
    public function source()
    {
        return Collection::wrap(spl_autoload_functions())
            ->filter(function ($func) {
                return \is_array($func) && $func[0] instanceof ClassLoader;
            })
            ->flatMap(function ($func) {
                return $func[0]->getClassMap();
            })
            ->filter(function ($value, $key) {
                if (
                    !(
                        Str::startsWith($key, "App\\") ||
                        Str::startsWith($key, "Orbitali\\")
                    )
                ) {
                    return false;
                }
                return is_subclass_of($key, IDatasource::class);
            })
            ->mapWithKeys(function ($item, $key) {
                return [$key => $key];
            });
    }
}
