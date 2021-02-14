<?php

namespace Orbitali\Http\Models;

use Silber\Bouncer\Database\Role as BRole;

class Role extends BRole
{
    use BouncerModelTranslater;
    public $type = "role";
}
