<?php
namespace Orbitali\Foundations\Datasources;

use Illuminate\Contracts\Cache\Repository as Cache;

class Languages
{
    public $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function source()
    {
        return $this->cache->rememberForever(
            "orbitali.datasource.languages",
            function () {
                $languages = collect(
                    require __DIR__ . "/../../Database/languages.php"
                );
                $languages = $languages->mapWithKeys(function ($q) {
                    return [$q => trans("native.language.{$q}")];
                });
                return $languages;
            }
        );
    }
}
