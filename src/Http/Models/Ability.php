<?php

namespace Orbitali\Http\Models;

use Silber\Bouncer\Database\Ability as BAbility;

class Ability extends BAbility
{
    use BouncerModelTranslater;
    public $type = "ability";
}
