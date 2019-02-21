<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\ExtendExtra;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends \App\User
{
    use HasRolesAndAbilities, SoftDeletes, ExtendExtra;

    protected $withoutExtra = ['id', 'name', 'email', 'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable);
        parent::__construct($attributes);
    }

    public function extras()
    {
        return $this->hasMany(UserExtra::class, 'user_id');
    }
}
