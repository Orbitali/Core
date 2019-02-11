<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;

class SitemapDetail extends Model
{
    use Cacheable;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "sitemap_details";
    protected $touches = ['parent'];

    public function parent()
    {
        return $this->belongsTo(Sitemap::class);
    }

    public function url()
    {
        return $this->morphOne(Url::class, "model");
    }

    public function extras()
    {
        return $this->hasMany(SitemapDetailExtra::class);
    }
}
