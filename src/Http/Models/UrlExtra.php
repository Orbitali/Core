<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class UrlExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $fillable = ["url_id", "key", "value"];
    protected $table = "url_extras";
    protected $touches = ["parent"];

    public function parent()
    {
        return $this->belongsTo(Url::class, "url_id");
    }
}
