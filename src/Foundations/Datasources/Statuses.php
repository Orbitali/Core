<?php
namespace Orbitali\Foundations\Datasources;

class Statuses implements IDatasource
{

    public function source()
    {
        return [
            "1" => trans(["native.language.active", "Active"]),
            "0" => trans(["native.language.passive", "Passive"]),
            "2" => trans(["native.language.draft", "Draft"]),
        ];
    }
}
