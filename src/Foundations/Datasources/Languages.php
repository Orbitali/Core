<?php
namespace Orbitali\Foundations\Datasources;

class Languages implements IDatasource
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
