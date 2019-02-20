<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class UserExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $fillable = ['user_id', 'key', 'value'];
    protected $table = 'user_extras';
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
