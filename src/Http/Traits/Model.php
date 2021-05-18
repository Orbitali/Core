<?php

namespace Orbitali\Http\Traits;

use Orbitali\Http\Models\Url;
use Orbitali\Http\Traits\StatusScope;
use Orbitali\Http\Traits\Structure;

trait Model
{
    use Structure, StatusScope;

    public function touchOwners()
    {
        Url::query()->update(["updated_at" => now()]);
    }
}
