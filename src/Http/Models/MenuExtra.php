<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class MenuExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = "menu_extras";
    protected $guarded = [];
    protected $touches = ["parent"];

    public function parent()
    {
        return $this->belongsTo(Menu::class, "menu_id");
    }
}
