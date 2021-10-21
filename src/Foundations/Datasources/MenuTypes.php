<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Foundations\Html\Html;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Models\Website;

class MenuTypes implements IDatasource
{
    public function source()
    {
        return [
            "root" => trans(["native.panel.menu.type.root", "Root"]),
            "route" => trans(["native.panel.menu.type.route", "Route"]),
            "datasource" => trans([
                "native.panel.menu.type.datasource",
                "Data Source",
            ]),
            "internal" => trans([
                "native.panel.menu.type.internal",
                "Internal",
            ]),
            "external" => trans([
                "native.panel.menu.type.external",
                "External",
            ]),
            "javascript" => trans([
                "native.panel.menu.type.javascript",
                "JavaScript",
            ]),
        ];
    }
}
