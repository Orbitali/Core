<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class MenuDetailExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = "menu_detail_extras";
    protected $guarded = [];
    protected $touches = ["parent"];

    public function parent()
    {
        return $this->belongsTo(MenuDetail::class, "menu_detail_id");
    }
}
