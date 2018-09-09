<?php

namespace Orbitali\Http\Models;

use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends \App\User
{
    use HasRolesAndAbilities;

    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable);
        parent::__construct($attributes);
    }

    public function extras()
    {
        return $this->hasMany(UserExtra::class, "user_id");
    }
}
