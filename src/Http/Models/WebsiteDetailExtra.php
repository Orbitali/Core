<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class WebsiteDetailExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = "website_detail_extras";
    protected $guarded = [];
    protected $touches = ["parent"];

    public function parent()
    {
        return $this->belongsTo(WebsiteDetail::class, "website_detail_id");
    }
}
