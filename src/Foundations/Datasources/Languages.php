<?php
namespace Orbitali\Foundations\Datasources;

class Languages
{
    public function source()
    {
        $languages = collect(require __DIR__ . "/../../Database/languages.php");
        $languages = $languages->mapWithKeys(function ($q) {
            return [$q => trans("native.language.{$q}")];
        });
        return $languages;
    }
}
