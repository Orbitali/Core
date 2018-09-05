<?php

namespace Orbitali\Http\Models;

use Illuminate\Notifications\Notifiable;

class User extends \App\User
{
    use Notifiable;

    protected $with = ["providers"];

    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable);
        parent::__construct($attributes);
    }

    public function providers()
    {
        return $this->hasMany(UserProvider::class, "user_id");
    }
}
