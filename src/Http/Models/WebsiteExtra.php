<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class WebsiteExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'website_extras';
    protected $guarded = [];
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(Website::class,'website_id');
    }
}
