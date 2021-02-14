<?php

namespace Orbitali\Http\Models;

use Silber\Bouncer\Database\Ability as BAbility;
use Orbitali\Http\Traits\BouncerModelTranslater;

class Ability extends BAbility
{
    use BouncerModelTranslater;
}
