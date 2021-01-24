<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class UserDetailExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = "user_detail_extras";
    protected $guarded = [];
    protected $touches = ["parent"];

    public function parent()
    {
        return $this->belongsTo(UserDetail::class, "user_detail_id");
    }
}
