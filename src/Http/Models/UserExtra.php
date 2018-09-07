<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class UserExtra extends Model
{
    use KeyValueModel;

    protected $fillable = ["user_id", "key", "value"];
    protected $table = "user_extras";
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
