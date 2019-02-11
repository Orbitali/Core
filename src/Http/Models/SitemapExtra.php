<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\KeyValueModel;
use Illuminate\Database\Eloquent\Model;

class SitemapExtra extends Model
{
    use KeyValueModel;

    public $timestamps = false;
    protected $table = 'sitemap_extras';
    protected $guarded = [];
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(Sitemap::class,'sitemap_id');
    }
}
