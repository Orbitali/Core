<?php

namespace Orbitali\Http\Models;

use Silber\Bouncer\Database\Role as BRole;
use Orbitali\Http\Traits\BouncerModelTranslater;

class Role extends BRole
{
    use BouncerModelTranslater;
}
