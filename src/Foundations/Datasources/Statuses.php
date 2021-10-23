<?php
namespace Orbitali\Foundations\Datasources;

class Statuses implements IDatasource
{
    public $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function source()
    {
        return $this->cache->rememberForever(
            "orbitali.datasource.statuses",
            function () {
                return [
                    "1" => trans(["native.language.active", "Active"]),
                    "0" => trans(["native.language.passive", "Passive"]),
                    "2" => trans(["native.language.draft", "Draft"]),
                ];
            }
        );
    }
}
