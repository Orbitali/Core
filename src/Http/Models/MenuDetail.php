<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendDetail;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;

class MenuDetail extends Model
{
    use Cacheable, ExtendExtra, ExtendDetail;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "menu_details";
    protected $touches = ["parent"];
    protected $fillable = ["id", "menu_id", "language", "country", "name"];
    protected $casts = [
        "language" => "string",
        "country" => "string",
        "name" => "string",
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, "menu_id");
    }

    public function extras()
    {
        return $this->hasMany(MenuDetailExtra::class);
    }
}
