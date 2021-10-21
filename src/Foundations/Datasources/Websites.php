<?php
namespace Orbitali\Foundations\Datasources;

use Orbitali\Foundations\Html\Html;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Models\Website;

class Websites implements IDatasource
{
    public function source()
    {
        return Website::with("detail")
            ->get()
            ->mapWithKeys(function ($website) {
                return [$website->id => $website->detail->name];
            });
    }
}
